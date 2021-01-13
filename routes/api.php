<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/registro','ControladorUsuario@registro');
Route::post('/login','ControladorUsuario@login');

Route::get('/usuario/{id}','ControladorUsuario@usuario');

Route::delete('/logout/{id}','ControladorUsuario@logout');

Route::middleware('auth:sanctum')->get('/obtener/distancia','ControladorArduino@distancia');
Route::middleware('auth:sanctum')->get('/obtener/humedad','ControladorArduino@humedad');
Route::middleware('auth:sanctum')->get('/obtener/movimiento','ControladorArduino@movimiento');
Route::middleware('auth:sanctum')->get('/obtener/luminosidad','ControladorArduino@luminosidad');
Route::middleware('auth:sanctum')->get('/obtener/temperatura','ControladorArduino@temperatura');
Route::get('/actualizar/cuenta/{id}','ControladorUsuario@verificarusuario')->where('id','[0-9]+');
Route::middleware('auth:sanctum')->post('/subir/onoff','ControladorArduino@OnOff');
