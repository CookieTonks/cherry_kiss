<?php

/**
 * This file contains the routes for the tools.
 */

use App\Http\Controllers\AdministrationController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    // Route::middleware(['can:ver_usuarios'])->group(function () {
    Route::get('/invoices/home', [AdministrationController::class, 'Home'])->name('invoices.home');
    // });
});
