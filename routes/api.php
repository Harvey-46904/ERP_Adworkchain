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

Route::resource('contrato', 'ContratoController',['except'=>['create','edit']]);
Route::resource('nomina', 'NominaController',['except'=>['create','edit']]);


Route::get("twitter","TwitterController@index");

Route::post("llamadas","ChatGtp@llamada");

Route::Post("register","AuthController@register");
Route::Post("Login","AuthController@Login");
Route::get("get_user","AuthController@index");



Route::middleware(['auth:sanctum'])->group(function (){
    Route::get("Logout","AuthController@Logout");
    Route::resource('tablero', 'TableroController',['except'=>['create','edit']]);
    Route::get('tareas_board/{id}', 'TareasController@get_task_board');
    Route::get("tablero_personal/{id}","TableroController@personal_tablero");
    Route::post("update_posicion","TareasController@update_posicion");
});


Route::get('data/{carpeta}/{nombre}', function ($carpeta,$nombre) {
    
    $public_path = public_path();
    $url = $public_path.'/storage/'.$carpeta."/".$nombre;// depende de root en el archivo filesystems.php.
    //verificamos si el archivo existe y lo retornamos
    return response()->file($url);
        return response()->download($url);
    
    //si no se encuentra lanzamos un error 404.
    abort(404);
  
  });