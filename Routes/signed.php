<?php

use Illuminate\Support\Facades\Route;

/**
 * 'signed' middleware and 'signed/blokbay' prefix applied to all routes (names start with 'signed.blokbay.').
 *
 * @see \App\Providers\Route::register
 */
Route::signed('blokbay', function () {
    Route::get('invoices/{invoice}', 'Payment@show')->name('invoices.show');
});
