<?php

namespace Modules\Blokbay\Services;

use App\Jobs\Banking\CreateBankingDocumentTransaction;
use App\Models\Banking\Transaction;
use App\Models\Document\Document;
use App\Utilities\Date;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\Blokbay\Models\BlokbayInvoice;

/**
 * Blokbay API (server side only) and the link between Akaunting invoices and Blokbay invoices.
 *
 * "Pay with Blokbay" creates the Blokbay invoice (POST /api/v1/invoices, send false: Akaunting sends its own email with the link),
 * the signed webhook invoice.paid registers the payment after the invoice is read again from the API, invoice.voided removes the link.
 */
class Blokbay
{
    public const DEFAULT_API_URL = 'https://blokbay.com';

    public const SUPPORTED_CURRENCIES = ['USD', 'EUR', 'GBP', 'CHF', 'JPY', 'CAD', 'AUD', 'SGD', 'HKD', 'AED'];

    public const LANGS = ['en', 'it', 'fr', 'de', 'es', 'pt', 'ru', 'zh', 'ja', 'hi', 'ko', 'tr', 'id', 'ar', 'vi', 'pl'];

    public const INVOICE_ID_RE = '/^inv_[a-z0-9]{6,40}$/';

    public const SECRET_KEY_RE = '/^sk_live_[A-Za-z0-9]{16,128}$/';

    public const WEBHOOK_SECRET_RE = '/^whsec_[A-Za-z0-9]{16,128}$/';

    public const SIGNATURE_TOLERANCE = 300;

    /* ---------------------------------------------------------------- settings */

    public static function apiUrl(): string
    {
        $url = rtrim(trim((string) setting('blokbay.api_url', self::DEFAULT_API_URL)), '/');

        return $url !== '' ? $url : self::DEFAULT_API_URL;
    }

    public static function secretKey(): string
    {
        return self::decrypt(setting('blokbay.secret_key'));
    }

    public static function webhookSecret(): string
    {
        return self::decrypt(setting('blokbay.webhook_secret'));
    }

    public static function isConfigured(): bool
    {
        return (bool) preg_match(self::SECRET_KEY_RE, self::secretKey());
    }

    public static function encrypt(string $value): string
    {
        return $value === '' ? '' : Crypt::encryptString($value);
    }

    public static function decrypt($value): string
    {
        if (empty($value) || ! is_string($value)) {
            return '';
        }

        try {
            return Crypt::decryptString($value);
        } catch (\Throwable $e) {
            return '';
        }
    }

    public static function webhookUrl($company_id): string
    {
        return route('blokbay.webhook', ['company_id' => $company_id]);
    }

    /* ---------------------------------------------------------------- API */

    /**
     * Calls the Blokbay API. Throws BlokbayException with the API error code ('number', 'no_wallet', 'links'...) on errors.
     */
    public static function request(string $method, string $path, ?array $payload = null, ?string $idempotency_key = null): array
    {
        $key = self::secretKey();

        if (! preg_match(self::SECRET_KEY_RE, $key)) {
            throw new BlokbayException(trans('blokbay::general.errors.not_configured'), 'not_configured');
        }

        $headers = [
            'Authorization' => 'Bearer ' . $key,
            'Accept' => 'application/json',
            'User-Agent' => 'Blokbay-Akaunting/1.0',
        ];

        if ($idempotency_key) {
            $headers['Idempotency-Key'] = substr($idempotency_key, 0, 100);
        }

        try {
            $http = Http::withHeaders($headers)->timeout(25)->connectTimeout(10);
            $response = $payload !== null ? $http->asJson()->send($method, self::apiUrl() . $path, ['json' => $payload]) : $http->send($method, self::apiUrl() . $path);
        } catch (\Throwable $e) {
            Log::warning('Blokbay: API unreachable: ' . $e->getMessage());

            throw new BlokbayException(trans('blokbay::general.errors.unreachable'), 'unreachable', 0);
        }

        $data = $response->json();

        if (! $response->successful()) {
            $code = is_array($data) && isset($data['error']) && is_string($data['error']) ? $data['error'] : 'http_' . $response->status();
            $message = is_array($data) && isset($data['message']) && is_string($data['message']) ? $data['message'] : trans('blokbay::general.errors.api');

            throw new BlokbayException('Blokbay: ' . mb_substr($message, 0, 300), $code, $response->status());
        }

        if (! is_array($data)) {
            throw new BlokbayException(trans('blokbay::general.errors.unexpected'), 'unexpected', $response->status());
        }

        return $data;
    }

    public static function validInvoice(array $data): bool
    {
        $base = preg_quote(self::apiUrl(), '#');

        return is_string($data['id'] ?? null) && preg_match(self::INVOICE_ID_RE, $data['id'])
            && is_string($data['url'] ?? null) && preg_match('#^' . $base . '/i/[0-9a-f]{64}$#', $data['url']);
    }

    /* ---------------------------------------------------------------- invoices */

    public static function canPay(Document $document): bool
    {
        return $document->type === Document::INVOICE_TYPE
            && in_array($document->status, ['sent', 'viewed', 'partial'])
            && $document->amount_due > 0;
    }

    /**
     * Customer, lines and taxes of the Akaunting invoice. Each line goes with its own amount and the taxes as one line,
     * so the Blokbay total is exactly the Akaunting total (or the amount due, when the invoice is partly paid).
     */
    public static function payload(Document $document): array
    {
        $currency = strtoupper((string) $document->currency_code);

        if (! in_array($currency, self::SUPPORTED_CURRENCIES)) {
            throw new BlokbayException(trans('blokbay::general.errors.currency', ['currency' => $currency, 'accepted' => implode(', ', self::SUPPORTED_CURRENCIES)]), 'currency');
        }

        $email = trim((string) ($document->contact_email ?: optional($document->contact)->email));

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new BlokbayException(trans('blokbay::general.errors.email'), 'customer');
        }

        $decimals = $currency === 'JPY' ? 0 : 2;
        $fmt = fn ($value) => number_format(round((float) $value, $decimals), $decimals, '.', '');
        $cents = fn ($value) => (int) round(((float) $value) * (10 ** $decimals));

        $total = $cents($document->amount);
        $due = $cents($document->amount_due);
        $lines = [];

        if ($due === $total) {
            foreach ($document->items as $item) {
                $amount = $cents($item->total);

                if ($amount === 0) {
                    continue;
                }

                $qty = (float) $item->quantity;
                $name = self::text($item->name ?: trans_choice('general.items', 1), 250);
                $exact = $qty > 0 && $cents($qty * $item->price) === $amount && round($qty, 3) == $qty;

                $lines[] = $exact
                    ? ['description' => $name, 'quantity' => self::qty($qty), 'unit_price' => $fmt($item->price), 'tax_rate' => 0]
                    : ['description' => self::text($name . ' (' . self::qty($qty) . ')', 300), 'quantity' => 1, 'unit_price' => $fmt($amount / (10 ** $decimals)), 'tax_rate' => 0];
            }

            $rest = $total - array_sum(array_map(fn ($l) => $cents($l['unit_price']) * (float) $l['quantity'], $lines));

            if ($rest > 0) {
                $lines[] = ['description' => trans('blokbay::general.taxes'), 'quantity' => 1, 'unit_price' => $fmt($rest / (10 ** $decimals)), 'tax_rate' => 0];
            } elseif ($rest < 0 || count($lines) > 50 || empty($lines)) {
                // Discounts on the whole invoice: one line with the invoice total.
                $lines = [];
            }
        }

        if (empty($lines)) {
            $lines[] = [
                'description' => self::text(trans('blokbay::general.balance_line', ['number' => $document->document_number]), 300),
                'quantity' => 1,
                'unit_price' => $fmt($due / (10 ** $decimals)),
                'tax_rate' => 0,
            ];
        }

        $contact_address = implode(', ', array_filter([
            $document->contact_address, $document->contact_zip_code, $document->contact_city, $document->contact_state, $document->contact_country,
        ]));

        $issuer = array_filter([
            'name' => self::text((string) setting('company.name'), 200),
            'email' => filter_var(setting('company.email'), FILTER_VALIDATE_EMAIL) ? substr((string) setting('company.email'), 0, 200) : null,
            'address' => self::text(implode(', ', array_filter([setting('company.address'), setting('company.zip_code'), setting('company.city'), setting('company.state'), setting('company.country')])), 500),
            'tax_id' => self::text((string) setting('company.tax_number'), 60),
        ]);

        $payload = [
            'customer' => array_filter([
                'name' => self::text((string) $document->contact_name, 200),
                'email' => substr($email, 0, 200),
                'address' => self::text($contact_address, 500),
                'tax_id' => self::text((string) $document->contact_tax_number, 60),
            ]),
            'currency' => $currency,
            'lines' => $lines,
            'external_ref' => substr('akaunting:' . $document->company_id . ':' . $document->id, 0, 100),
            'send' => false,
        ];

        if (! empty($issuer['name'])) {
            $payload['issuer'] = $issuer;
        }

        $number = substr(preg_replace('/[^A-Za-z0-9\/._-]/', '', (string) $document->document_number), 0, 40);

        if ($number !== '') {
            $payload['number'] = $number;
        }

        if ($document->issued_at) {
            $payload['issue_date'] = Date::parse($document->issued_at)->toDateString();
        }

        if ($document->due_at && (! $document->issued_at || Date::parse($document->due_at)->gte(Date::parse($document->issued_at)->startOfDay()))) {
            $payload['due_date'] = Date::parse($document->due_at)->toDateString();
        }

        $lang = strtolower(substr((string) setting('default.locale', app()->getLocale()), 0, 2));

        if (in_array($lang, self::LANGS)) {
            $payload['lang'] = $lang;
        }

        return $payload;
    }

    /**
     * Creates the Blokbay invoice of an Akaunting invoice, or returns the open one.
     */
    public static function createInvoice(Document $document): BlokbayInvoice
    {
        if (! self::canPay($document)) {
            throw new BlokbayException(trans('blokbay::general.errors.not_payable'), 'not_payable');
        }

        $row = BlokbayInvoice::forDocument($document);

        if ($row && $row->status === 'open' && $row->url) {
            return $row;
        }

        $payload = self::payload($document);
        $attempt = ($row ? $row->attempt : 0) + 1;
        $key = 'akaunting-invoice:' . $document->company_id . ':' . $document->id . ':' . $attempt;

        try {
            $data = self::request('POST', '/api/v1/invoices', $payload, $key);
        } catch (BlokbayException $e) {
            if ($e->apiCode !== 'number' || ! isset($payload['number'])) {
                throw $e;
            }

            // The number is already used by another Blokbay invoice (e.g. a cancelled one): Blokbay numbers this one.
            unset($payload['number']);
            $data = self::request('POST', '/api/v1/invoices', $payload, $key . ':auto');
        }

        if (! self::validInvoice($data)) {
            throw new BlokbayException(trans('blokbay::general.errors.unexpected'), 'unexpected');
        }

        $values = [
            'blokbay_id' => $data['id'],
            'url' => $data['url'],
            'number' => substr((string) ($data['number'] ?? ''), 0, 64),
            'status' => 'open',
            'attempt' => $attempt,
            'transaction_id' => null,
        ];

        if ($row) {
            $row->update($values);
        } else {
            $row = BlokbayInvoice::create($values + ['company_id' => $document->company_id, 'document_id' => $document->id]);
        }

        return $row;
    }

    /**
     * Cancels the Blokbay link of an invoice (the Akaunting invoice was cancelled).
     */
    public static function voidInvoice(Document $document): void
    {
        $row = BlokbayInvoice::forDocument($document);

        if (! $row || $row->status !== 'open' || ! $row->blokbay_id) {
            return;
        }

        try {
            self::request('POST', '/api/v1/invoices/' . $row->blokbay_id . '/void', []);
        } catch (BlokbayException $e) {
            Log::warning('Blokbay: unable to cancel ' . $row->blokbay_id . ': ' . $e->getMessage());
        }

        $row->update(['status' => 'void', 'url' => null]);
    }

    /**
     * Invoice event from the webhook, applied on the invoice read again from the API: paid registers the payment once, void removes
     * the link. Returns paid, void or duplicate.
     */
    public static function applyInvoice(BlokbayInvoice $row, array $fresh): string
    {
        $status = $fresh['status'] ?? '';

        if ($status === 'paid') {
            return DB::transaction(function () use ($row, $fresh) {
                $row = BlokbayInvoice::whereKey($row->id)->lockForUpdate()->first();

                if (! $row || $row->status === 'paid') {
                    return 'duplicate';
                }

                $document = Document::where('company_id', $row->company_id)->where('type', Document::INVOICE_TYPE)->find($row->document_id);
                $transaction = $document ? self::registerPayment($document, $row, $fresh) : null;

                $row->update(['status' => 'paid', 'url' => null, 'transaction_id' => $transaction ? $transaction->id : null]);

                return 'paid';
            });
        }

        if ($status === 'void' && $row->status === 'open') {
            $row->update(['status' => 'void', 'url' => null]);

            return 'void';
        }

        return 'duplicate';
    }

    protected static function registerPayment(Document $document, BlokbayInvoice $row, array $fresh): ?Transaction
    {
        $payment = is_array($fresh['payment'] ?? null) ? $fresh['payment'] : [];
        $reference = substr('Blokbay ' . $row->blokbay_id, 0, 190);

        // Already registered (e.g. by a previous delivery before a crash).
        $existing = Transaction::where('company_id', $document->company_id)->where('document_id', $document->id)->where('reference', $reference)->first();

        if ($existing) {
            return $existing;
        }

        if (in_array($document->status, ['paid', 'cancelled']) || strtoupper((string) ($fresh['currency'] ?? '')) !== strtoupper((string) $document->currency_code)) {
            Log::warning('Blokbay: payment of ' . $row->blokbay_id . ' not registered on invoice ' . $document->id . ' (status ' . $document->status . ', currency ' . ($fresh['currency'] ?? '') . ').');

            return null;
        }

        $paid_at = (string) ($payment['paid_at'] ?? ($fresh['paid_at'] ?? ''));
        $paid_at = $paid_at !== '' ? Date::parse($paid_at)->toDateTimeString() : Date::now()->toDateTimeString();
        $details = trim(implode(' ', array_filter([
            $payment['coin'] ?? null,
            isset($payment['network']) ? '(' . $payment['network'] . ')' : null,
            isset($payment['tx']) ? 'tx ' . $payment['tx'] : null,
        ])));

        $request = [
            'type' => 'income',
            'number' => app(\App\Interfaces\Utility\TransactionNumber::class)->getNextNumber('income', '', null),
            'company_id' => $document->company_id,
            'account_id' => (int) setting('blokbay.account_id', setting('default.account')),
            'paid_at' => $paid_at,
            'payment_method' => 'blokbay',
            'reference' => $reference,
            'description' => substr(trim('Blokbay ' . ($fresh['number'] ?? '') . ' ' . $details), 0, 250),
            'currency_code' => $document->currency_code,
            'currency_rate' => $document->currency_rate,
            'notify' => 0,
        ];

        $amount_due = round((float) $document->amount_due, currency($document->currency_code)->getPrecision());
        $request['amount'] = min($amount_due, (float) ($fresh['total'] ?? $amount_due));

        if ($request['amount'] <= 0) {
            return null;
        }

        return dispatch_sync(new CreateBankingDocumentTransaction($document, $request));
    }

    /* ---------------------------------------------------------------- webhook */

    /**
     * Blokbay-Signature: t=<unix seconds>,v1=<hex HMAC-SHA256 of "<t>.<raw body>">, 300 s tolerance, constant time comparison.
     */
    public static function verifySignature(string $raw, string $header, string $secret, ?int $now = null): bool
    {
        if ($secret === '' || $header === '') {
            return false;
        }

        $t = null;
        $signatures = [];

        foreach (explode(',', $header) as $part) {
            [$k, $v] = array_pad(explode('=', trim($part), 2), 2, '');

            if ($k === 't' && ctype_digit($v)) {
                $t = (int) $v;
            } elseif ($k === 'v1' && preg_match('/^[0-9a-f]{64}$/', $v)) {
                $signatures[] = $v;
            }
        }

        if ($t === null || empty($signatures) || abs(($now ?? time()) - $t) > self::SIGNATURE_TOLERANCE) {
            return false;
        }

        $expected = hash_hmac('sha256', $t . '.' . $raw, $secret);

        foreach ($signatures as $signature) {
            if (hash_equals($expected, $signature)) {
                return true;
            }
        }

        return false;
    }

    /* ---------------------------------------------------------------- helpers */

    /**
     * Blokbay refuses web addresses and domains in texts: they are removed.
     */
    public static function text(string $value, int $max): string
    {
        $value = preg_replace('#(https?://|www\.)\S+#i', '', $value);
        $value = preg_replace('/\b[a-z0-9-]+(\.[a-z0-9-]+)*\.[a-z]{2,24}\b/i', '', $value);
        $value = trim(preg_replace('/\s+/', ' ', $value));

        return mb_substr($value, 0, $max);
    }

    protected static function qty(float $qty): string
    {
        return rtrim(rtrim(number_format($qty, 3, '.', ''), '0'), '.');
    }
}
