
<?php

/**
 * This file contains the routes for the tools.
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::group(['middleware' => ['auth']], function () {
    // Route::middleware(['can:ver_ordenes'])->group(function () {
    Route::get('/materiales/home', [OrderController::class, 'index'])->name('orders.home');
    Route::get('/budgets/{budgetId}/orders', [OrderController::class, 'showBudgetOrders'])->name('budgets.show.orders');
    Route::get('/budgets/{budgetId}/order/{ItemId}/pdf', [OrderController::class, 'makeOrder'])->name('budgets.pdf.order');

    // Route::get('/budgets/show/{budgetId}/materials', [MaterialController::class, 'show'])->name('budgets.show.materials');
    // Route::post('/budgets/create/{budgetId}/materials', [MaterialController::class, 'store'])->name('budgets.create.materials');
    // Route::delete('/budgets/destroy/{materialId}/materials', [MaterialController::class, 'destroy'])->name('budgets.destroy.materials');
    // Route::put('/budgets/edit/{materialId}/materials', [MaterialController::class, 'update'])->name('budgets.edit.materials');

    // });
});
