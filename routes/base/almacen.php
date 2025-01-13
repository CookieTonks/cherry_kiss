
<?php

/**
 * This file contains the routes for the tools.
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlmacenController;

Route::group(['middleware' => ['auth']], function () {
    // Route::middleware(['can:ver_cotizaciones'])->group(function () {
    Route::get('/almacen/home', [AlmacenController::class, 'home'])->name('almacen.home');
    // });
});
