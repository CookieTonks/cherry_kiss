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
        Route::post('/invoice/alta', [InvoiceController::class, 'invoice_alta'])->name('invoice.alta');
        Route::post('/item/{id}/invoice_number', [InvoiceController::class, 'partida_factura'])->name('factura.partida.oc');
        Route::get('/factura/invoice_number/{id}/partidas', [InvoiceController::class, 'invoice_partidas'])->name('factura.partida.oc');
        Route::post('/invoice/{id}/estatus', [InvoiceController::class, 'invoice_estatus'])->name('invoice.estatus');

    });
});
