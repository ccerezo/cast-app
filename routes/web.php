<?php

use App\Http\Controllers\BodegaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\LineaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TallaController;
use App\Http\Controllers\TallajeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('bodegas', BodegaController::class)->names('bodegas')->middleware('auth');

Route::resource('categorias', CategoriaController::class)->names('categorias')->middleware('auth');

Route::resource('colors', ColorController::class)->names('colors')->middleware('auth');

Route::resource('lineas', LineaController::class)->names('lineas')->middleware('auth');

Route::resource('marcas', MarcaController::class)->names('marcas')->middleware('auth');

Route::resource('modelos', ModeloController::class)->names('modelos')->middleware('auth');

Route::resource('tallas', TallaController::class)->names('tallas')->middleware('auth');

Route::resource('tallajes', TallajeController::class)->names('tallajes')->middleware('auth');

Route::resource('productos', ProductoController::class)->names('productos')->middleware('auth');
