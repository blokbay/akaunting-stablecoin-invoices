<?php

namespace Modules\Blokbay\Http\Controllers;

use App\Models\Common\Company;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\Blokbay\Models\BlokbayInvoice;
use Modules\Blokbay\Services\Blokbay;
use Modules\Blokbay\Services\BlokbayException;

/**
 * Signed webhook: invoice.paid, invoice.voided, invoice.overdue (and the payment.* events of the gateway, ignored here).
 * The body is never trusted: the invoice is read again from the API before the Akaunting invoice changes.
 * 200 for handled, duplicate and unknown events, 400/401 for a bad payload or signature, 503 when the API cannot be read (Blokbay retries).
 */
class Webhook extends Controller
{
    public function handle(Request $request, $company_id)
    {
        $text = fn (string $msg, int $status = 200) => response($msg, $status)->header('Content-Type', 'text/plain');

        $company = Company::find((int) $company_id);

        if (! $company || ! $company->enabled) {
            return $text('unknown company', 404);
        }

        $company->makeCurrent();

        $raw = $request->getContent();

        if (! Blokbay::verifySignature($raw, (string) $request->header('Blokbay-Signature', ''), Blokbay::webhookSecret())) {
            Log::warning('Blokbay: webhook with an invalid signature for company ' . $company->id);

            return $text('bad signature', 401);
        }

        $event = json_decode($raw, true);

        if (! is_array($event) || ! is_string($event['type'] ?? null)) {
            return $text('bad payload', 400);
        }

        if ($event['type'] === 'ping') {
            return $text('pong');
        }

        if (! str_starts_with($event['type'], 'invoice.')) {
            return $text('ignored');
        }

        $inv_id = is_array($event['data'] ?? null) ? (string) ($event['data']['id'] ?? '') : '';

        if (! preg_match(Blokbay::INVOICE_ID_RE, $inv_id)) {
            return $text('unknown invoice');
        }

        $row = BlokbayInvoice::where('company_id', $company->id)->where('blokbay_id', $inv_id)->first();

        if (! $row) {
            return $text('unknown invoice');
        }

        try {
            $fresh = Blokbay::request('GET', '/api/v1/invoices/' . $inv_id);
        } catch (BlokbayException $e) {
            Log::warning('Blokbay: unable to read the invoice ' . $inv_id . ': ' . $e->getMessage());

            return $text('retry', 503);
        }

        if (($fresh['id'] ?? null) !== $inv_id) {
            return $text('unknown invoice');
        }

        try {
            return $text(Blokbay::applyInvoice($row, $fresh));
        } catch (\Throwable $e) {
            report($e);

            return $text('retry', 503);
        }
    }
}
