
<?php

/**
 * This file contains the routes for the tools.
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BudgetController;

Route::group(['middleware' => ['auth']], function () {
    // Route::middleware(['can:ver_cotizaciones'])->group(function () {
    Route::get('/cotizaciones/home', [BudgetController::class, 'index'])->name('budgets.index');
    Route::post('/cotizaciones/store', [BudgetController::class, 'store'])->name('budgets.store');
    Route::get('/cotizaciones/show/{budgetId}', [BudgetController::class, 'show'])->name('budgets.show');
    Route::get('/cotizaciones/make/{budgetId}', [BudgetController::class, 'make'])->name('budgets.make');
    Route::get('/cotizaciones/edit/{budgetId}', [BudgetController::class, 'edit'])->name('budgets.edit');
    Route::delete('/cotizaciones/delete/{budgetId}', [BudgetController::class, 'destroyBudget'])->name('budgets.destroy');
    Route::get('/budgets/{id}/items', [BudgetController::class, 'getItems']);


    Route::post('/item/store/{budgetId}', [BudgetController::class, 'storeItem'])->name('item.store');
    Route::delete('/items/delete/{itemId}', [BudgetController::class, 'destroyItem'])->name('item.destroy');



    // });
});
