<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StavkaMenijaController;
use App\Http\Controllers\VrstaStavkeMenijaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GostController;
use App\Http\Controllers\KonobarController;
use App\Http\Controllers\MenadzerController;
use App\Http\Controllers\RadnaSmenaController;
use App\Http\Controllers\PorudzbinaController;
use App\Http\Controllers\StavkaPorudzbineController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\GostAuthController;
use App\Http\Controllers\MenadzerAuthController;
use App\Http\Controllers\KonobarAuthController;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/gostRegister', [GostAuthController::class, 'register']);
Route::post('/menadzerRegister', [MenadzerAuthController::class, 'register']);
Route::post('/konobarRegister', [KonobarAuthController::class, 'register']);


Route::resource('stavkaMenija', StavkaMenijaController::class)->only(['show', 'index','update', 'store','destroy']);
Route::resource('vrstaStavkeMenija', VrstaStavkeMenijaController::class)->only(['show', 'index']);
Route::resource('user', UserController::class)->only(['show', 'update']);
Route::resource('gost', GostController::class)->only(['show', 'index','store','update']);
Route::resource('menadzer', MenadzerController::class)->only(['show', 'index','store','update']);
Route::resource('konobar', KonobarController::class)->only(['show', 'index','store','update']);
Route::resource('radnaSmena', RadnaSmenaController::class)->only(['show', 'index','store','update']);
Route::resource('porudzbina', PorudzbinaController::class)->only(['show', 'index','store','update','destroy']);
Route::resource('stavkaPorudzbine', StavkaPorudzbineController::class)->only(['show', 'index','store','destroy']);

