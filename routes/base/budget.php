
<?php

/**
 * This file contains the routes for the tools.
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BudgetController;

Route::group(['middleware' => ['auth']], function () {
    Route::middleware(['can:ver_cotizaciones'])->group(function () {
        Route::get('/cotizaciones/home', [BudgetController::class, 'index'])->name('cotizaciones.home');
        Route::post('/cotizaciones/create', [BudgetController::class, 'create'])->name('cotizaciones.create');
        Route::delete('/cotizaciones/delete/{id}', [BudgetController::class, 'destroy'])->name('cotizaciones.destroy');
    });
});
