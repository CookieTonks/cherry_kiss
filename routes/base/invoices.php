<?php

/**
 * This file contains the routes for the tools.
 */

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::middleware(['can:facturacion_dashboard'])->group(function () {
        Route::get('/invoices/home', [InvoiceController::class, 'Home'])->name('invoice.home');
        Route::post('/invoices/ot/{id}/liberacion', [InvoiceController::class, 'liberacion'])->name('invoice.ot.liberacion');
        Route::get('/oc_number/{id}/factura', [InvoiceController::class, 'liberacion'])->name('oc_number.factura');
    });
});
