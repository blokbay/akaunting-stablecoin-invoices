<?php

use Illuminate\Support\Facades\Route;

/**
 * Signed webhook from Blokbay: public, without session, cookies or CSRF. The company comes from the URL and the request
 * is accepted only with a valid Blokbay-Signature made with the webhook secret of that company.
 */
Route::post('{company_id}/blokbay/webhook', 'Modules\Blokbay\Http\Controllers\Webhook@handle')
    ->where('company_id', '[0-9]+')
    ->name('blokbay.webhook');
