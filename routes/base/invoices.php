<?php

/**
 * This file contains the routes for the tools.
 */

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    // Route::middleware(['can:ver_usuarios'])->group(function () {
    Route::get('/invoices/home', [InvoiceController::class, 'Home'])->name('invoices.home');
    Route::post('/invoices/ot/{id}/liberacion', [InvoiceController::class, 'liberacion'])->name('invoice.ot.liberacion');
    // });
});
