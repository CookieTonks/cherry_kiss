<?php

/**
 * This file contains the routes for the tools.
 */

use App\Http\Controllers\ShippingController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    // Route::middleware(['can:ver_usuarios'])->group(function () {
    Route::get('/shipping/home', [ShippingController::class, 'Home'])->name('shipping.home');
    Route::post('/shipping/ot/{id}/salida_factura', [ShippingController::class, 'salida_factura'])->name('shipping.ot.salida_factura');



    // });
});
