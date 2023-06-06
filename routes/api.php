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

Route::resource('empleados', 'EmpleadosController',['except'=>['create','edit']]);
Route::resource('clientes', 'ClientesController',['except'=>['create','edit']]);
Route::resource('tareas', 'TareasController',['except'=>['create','edit']]);


Route::get("twitter","TwitterController@index");

Route::post("llamada","ChatGtp@llamada");