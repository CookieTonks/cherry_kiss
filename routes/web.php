<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group([], base_path('routes/base/budget.php'));
Route::group([], base_path('routes/base/profiles.php'));
Route::group([], base_path('routes/base/roles.php'));
Route::group([], base_path('routes/base/orders.php'));



require __DIR__ . '/auth.php';
