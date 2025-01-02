<?php

/**
 * This file contains the routes for the tools.
 */

use App\Http\Controllers\ComprasController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    // Route::middleware(['can:ver_usuarios'])->group(function () {
    Route::get('/compras/home', [ComprasController::class, 'Home'])->name('compras.home');
    // });
});
