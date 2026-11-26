<?php

use Illuminate\Support\Facades\Route;

/**
 * 'portal' middleware and 'portal/blokbay' prefix applied to all routes (names start with 'portal.blokbay.').
 *
 * @see \App\Providers\Route::register
 */
Route::portal('blokbay', function () {
    Route::get('invoices/{invoice}', 'Payment@show')->name('invoices.show');
});
