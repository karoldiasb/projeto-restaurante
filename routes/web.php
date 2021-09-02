<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [App\Http\Controllers\AuthController::class, 'create'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('logar');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('/registrar', [App\Http\Controllers\UserController::class, 'create'])->name('registrar');
Route::post('/registrar', [App\Http\Controllers\UserController::class, 'store'])->name('registrar');

Route::resource('/restaurantes', App\Http\Controllers\RestauranteController::class);
Route::resource('/cardapios', App\Http\Controllers\CardapioController::class);
Route::resource('/produtos', App\Http\Controllers\ProdutoController::class);
