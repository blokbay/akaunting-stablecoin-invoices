<?php

use Illuminate\Support\Facades\Route;

/**
 * 'admin' middleware and '{company_id}/blokbay' prefix applied to all routes (names start with 'blokbay.').
 *
 * @see \App\Providers\Route::register
 */
Route::admin('blokbay', function () {
    Route::get('settings', 'Settings@edit')->name('settings.edit');
    Route::patch('settings', 'Settings@update')->name('settings.update');
    Route::post('invoices/{document_id}', 'Invoices@store')->where('document_id', '[0-9]+')->name('invoices.store');
});
