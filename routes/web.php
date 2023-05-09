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

Auth::routes();

Route::resource('servicios', App\Http\Controllers\ServicioController::class)->middleware('auth');
Route::resource('combos', App\Http\Controllers\ComboController::class)->middleware('auth');
Route::resource('categorias', App\Http\Controllers\CategoriaController::class)->middleware('auth');
Route::resource('agendas', App\Http\Controllers\AgendaController::class)->middleware('auth');
Route::resource('historials', App\Http\Controllers\HistorialController::class)->middleware('auth');
Route::resource('productos', App\Http\Controllers\ProductoController::class)->middleware('auth');
Route::resource('descartables', App\Http\Controllers\DescartableController::class)->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
