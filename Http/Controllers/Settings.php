<?php

namespace Modules\Blokbay\Http\Controllers;

use App\Abstracts\Http\Controller;
use App\Models\Banking\Account;
use App\Utilities\Modules as Utility;
use Illuminate\Http\Request;
use Modules\Blokbay\Services\Blokbay;

class Settings extends Controller
{
    public function edit()
    {
        $setting = [
            'api_url' => Blokbay::apiUrl(),
            'account_id' => setting('blokbay.account_id', setting('default.account')),
        ];

        return view('blokbay::settings', [
            'setting' => $setting,
            'has_key' => Blokbay::secretKey() !== '',
            'key_hint' => Blokbay::secretKey() !== '' ? substr(Blokbay::secretKey(), 0, 12) . '...' : '',
            'has_secret' => Blokbay::webhookSecret() !== '',
            'webhook_url' => Blokbay::webhookUrl(company_id()),
            'accounts' => Account::enabled()->orderBy('name')->pluck('name', 'id'),
        ]);
    }

    public function update(Request $request)
    {
        $errors = [];

        $api_url = rtrim(trim((string) $request->get('api_url', '')), '/');
        $api_url = $api_url === '' ? Blokbay::DEFAULT_API_URL : $api_url;

        if (! preg_match('#^https?://[^\s/?\#]+(:\d+)?$#i', $api_url) || (str_starts_with(strtolower($api_url), 'http://') && ! preg_match('#^http://(127\.0\.0\.1|localhost)(:\d+)?$#i', $api_url))) {
            $errors['api_url'] = [trans('blokbay::general.errors.api_url')];
        }

        $secret_key = trim((string) $request->get('secret_key', ''));

        if ($secret_key !== '' && ! preg_match(Blokbay::SECRET_KEY_RE, $secret_key)) {
            $errors['secret_key'] = [trans('blokbay::general.errors.secret_key')];
        }

        $webhook_secret = trim((string) $request->get('webhook_secret', ''));

        if ($webhook_secret !== '' && ! preg_match(Blokbay::WEBHOOK_SECRET_RE, $webhook_secret)) {
            $errors['webhook_secret'] = [trans('blokbay::general.errors.webhook_secret')];
        }

        $account_id = (int) $request->get('account_id');

        if (! Account::where('company_id', company_id())->whereKey($account_id)->exists()) {
            $errors['account_id'] = [trans('blokbay::general.errors.account')];
        }

        if ($errors) {
            return response()->json([
                'success' => false,
                'error' => true,
                'message' => implode(' ', array_map(fn ($e) => $e[0], $errors)),
                'errors' => $errors,
                'data' => null,
            ], 422);
        }

        setting()->set('blokbay.api_url', $api_url);
        setting()->set('blokbay.account_id', $account_id);

        // Empty fields keep the saved key and secret (they are never shown again).
        if ($secret_key !== '') {
            setting()->set('blokbay.secret_key', Blokbay::encrypt($secret_key));
        }

        if ($webhook_secret !== '') {
            setting()->set('blokbay.webhook_secret', Blokbay::encrypt($webhook_secret));
        }

        setting()->save();

        Utility::clearPaymentMethodsCache();

        $message = trans('messages.success.updated', ['type' => trans_choice('general.settings', 2)]);

        flash($message)->success();

        return response()->json([
            'success' => true,
            'error' => false,
            'message' => $message,
            'data' => null,
            'redirect' => route('blokbay.settings.edit'),
        ]);
    }
}
