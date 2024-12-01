
<?php

/**
 * This file contains the routes for the tools.
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::group(['middleware' => ['auth']], function () {
    Route::middleware(['can:ver_ordenes'])->group(function () {
        Route::get('/ordenes/home', [OrderController::class, 'index'])->name('ordenes.home');
        Route::post('/ordenes/create', [OrderController::class, 'store'])->name('permissions.store');
        Route::delete('/ordenes/delete/{id}', [OrderController::class, 'destroy'])->name('permissions.destroy');
    });
});
