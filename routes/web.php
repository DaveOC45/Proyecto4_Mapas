<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministracionController;
use App\Http\Controllers\MapaController;
use App\Http\Controllers\GimcanaController;

//---------- ECOSISTEMA DEL ADMINISTRADOR ------------//

//LEER AJAX
//Ruta para leer ubicación.
Route::post('leer',[AdministracionController::class, 'leerController']);
//Ruta para insertar/crear ubicación.
Route::post('crear',[AdministracionController::class, 'crearController']);
//Esto de aquí lo hicimos para poder hacer el select de tipo de ubicación.
Route::post('leertipo',[AdministracionController::class, 'lecturatipoubicacion']);
//Ruta para eliminar ubicación.
Route::delete('eliminar/{id}', [AdministracionController::class, 'eliminarController']);

//---------- ECOSISTEMA DE LOS MAPAS ------------//
//Ruta para el login
Route::get('login', [MapaController::class, 'login']);
Route::post('loginPost',[MapaController::class, 'loginPost']);
//Ruta para el registro de usuarios
Route::get('registro',[MapaController::class, 'registro']);
Route::post('registroPost',[MapaController::class, 'registroPost']);
//Ruta para el logout
Route::get('logout',[MapaController::class,'logout']);
//Ruta para entar al mapa
Route::get('/', [MapaController::class, 'mapa']);
//Ruta para elegir en que MODO jugar a la gimcana (solo o por equipos)
Route::get('/indexgimcana', [MapaController::class, 'indexgimcana']);
//Ruta para ser anfitrion o unirse a un equipo
Route::get('/gimcanaequipos', [MapaController::class, 'gimcanaequipos']);