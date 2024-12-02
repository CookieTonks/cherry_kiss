
<?php

/**
 * This file contains the routes for the tools.
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BudgetController;

Route::group(['middleware' => ['auth']], function () {
    Route::middleware(['can:ver_cotizaciones'])->group(function () {
        Route::get('/cotizaciones/home', [BudgetController::class, 'index'])->name('budgets.index');
        Route::post('/cotizaciones/store', [BudgetController::class, 'store'])->name('budgets.store');
        Route::delete('/cotizaciones/delete/{id}', [BudgetController::class, 'destroy'])->name('budgets.destroy');
        Route::get('/budgets/{id}/items', [BudgetController::class, 'getItems']);
    });
});
