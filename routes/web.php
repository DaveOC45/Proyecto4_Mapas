<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministracionController;

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
/*LOGIN Y LOGOUT*/
Route::post('login', [AdministracionController::class, 'loginP']);
Route::get('logout', [AdministracionController::class, 'logout']);


//RUTAS PANEL PRINCIPAL
Route::get('/', function () {
    return view('login');
});
Route::get('cPanelAdmin', function () {
    return view('cPanelAdmin');
});
Route::get('principal', function () {
    return view('principal');
});
Route::get('usuarios', function () {
    return view('usuarios');
});

//AJAX UBICACION
// ruta para leer ubicación.
Route::post('leer',[AdministracionController::class, 'leerController']);
// ruta para insertar/crear ubicación.
Route::post('crear',[AdministracionController::class, 'crearController']);
//Esto de aquí lo hicimos para poder hacer el select de tipo de ubicación.
Route::post('leertipo',[AdministracionController::class, 'lecturatipoubicacion']);
// ruta para modificar ubicación.
Route::put('modificar',[AdministracionController::class, 'modificarController']);
// ruta para eliminar ubicación.
Route::delete('eliminar/{id}', [AdministracionController::class, 'eliminarController']);


//AJAX USUARIOS
// ruta para leer usuario.
Route::post('leeruser',[AdministracionController::class, 'leerControlleruser']);
// ruta para insertar/crear usuario.
Route::post('crearuser',[AdministracionController::class, 'crearControlleruser']);
//Esto de aquí lo hicimos para poder hacer el select de tipo de usuario.
Route::post('leertipouser',[AdministracionController::class, 'lecturatipoubicacionuser']);
// ruta para modificar
Route::put('modificaruser',[AdministracionController::class, 'modificarControlleruser']);
// ruta para eliminar usuario.
Route::delete('eliminaruser/{id}', [AdministracionController::class, 'eliminarControlleruser']);