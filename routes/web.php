<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LiquidacionSueldoController;
use App\Http\Controllers\HorarioController;

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

Route::get('/informes/liquidacion', function () {
    return view('/informes/template-liquidacion');
});

Route::get('/', function () {
    return view('welcome');
});

Route::apiResource('horario', HorarioController::class);

Route::apiResource('liquidacionsueldo', LiquidacionSueldoController::class);


Route::post('liquidacionsueldo/storeFile/{id}', [LiquidacionSueldoController::class, 'storeFile']);
