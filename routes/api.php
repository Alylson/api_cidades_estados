<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\CidadeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Rotas para autenticacao
Route::post('auth/login', [AuthController::class, 'login']);

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'auth'
    ],
    function ($router) {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/authUser', [AuthController::class, 'getAuthUser']);
});

// Rotas para crud estados
Route::resource('estado',EstadoController::class)->middleware('auth:api');

// Rotas para crud cidades
Route::resource('cidade',CidadeController::class)->middleware('auth:api');
