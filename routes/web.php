<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MonedaController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\BackendMonedaController;


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

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('backend', [BackendController::class, 'main']);

Route::get('backend/moneda', [BackendController::class, 'moneda']);
Route::resource('moneda', MonedaController::class, ['names' => 'backend.moneda']);
Route::resource('ajaxmoneda', BackendMonedaController::class, ['names' => 'backend.moneda']);
