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
Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'estado'
    ],
    function ($router) {
    Route::get('index',[EstadoController::class, 'listarEstados']);
    Route::get('{id}',[EstadoController::class, 'buscarEstadoPorId']);
    Route::post('cadastrar',[EstadoController::class, 'cadastrarEstado']);
    Route::put('atualizar/{id}',[EstadoController::class, 'atualizarEstado']);
    Route::delete('excluir/{id}',[EstadoController::class, 'excluirEstado']);
});

// Rotas para crud cidades
Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'cidade'
    ],
    function ($router) {
    Route::get('index',[CidadeController::class, 'listarCidades']);
    Route::get('{id}',[CidadeController::class, 'buscarCidadePorId']);
    Route::post('cadastrar',[CidadeController::class, 'cadastrarCidade']);
    Route::put('atualizar/{id}',[CidadeController::class, 'atualizarCidade']);
    Route::delete('excluir/{id}',[CidadeController::class, 'excluirCidade']);
});
