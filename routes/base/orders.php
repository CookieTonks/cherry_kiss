
<?php

/**
 * This file contains the routes for the tools.
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::group(['middleware' => ['auth']], function () {
    Route::middleware(['can:ver_ordenes'])->group(function () {
        Route::get('/orders/home', [OrderController::class, 'index'])->name('permissions.index');
        Route::post('/orders/create', [OrderController::class, 'store'])->name('permissions.store');
        Route::delete('/orders/delete/{id}', [OrderController::class, 'destroy'])->name('permissions.destroy');
    });
});
