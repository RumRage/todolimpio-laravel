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
Route::get('historiales', [App\Http\Controllers\AgendaController::class, 'historiales'])->middleware('auth')->name('historiales.index');
Route::get('cancelados', [App\Http\Controllers\AgendaController::class, 'cancelados'])->middleware('auth')->name('cancelados.index');
Route::resource('productos', App\Http\Controllers\ProductoController::class)->middleware('auth');
Route::resource('descartables', App\Http\Controllers\DescartableController::class)->middleware('auth');
Route::put('agendas/{id}/hecho', [App\Http\Controllers\AgendaController::class, 'marcarComoHecho'])->name('agendas.hecho');
Route::put('agendas/{id}/cancelado', [App\Http\Controllers\AgendaController::class, 'marcarComoCancelado'])->name('agendas.cancelado');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
