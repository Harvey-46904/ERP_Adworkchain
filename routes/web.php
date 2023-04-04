<?php

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
Route::resource('empleados', 'EmpleadosController',['except'=>['create','edit']]);
Route::resource('clientes', 'ClientesController',['except'=>['create','edit']]);
Route::resource('tareas', 'TareasController',['except'=>['create','edit']]);