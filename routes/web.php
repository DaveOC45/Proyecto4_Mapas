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
//Ruta para jugar a la gimcana
Route::get('/gimcana', [MapaController::class, 'gimcana']);
//Ruta para ser anfitrion o unirse a un equipo
Route::get('/gimcanaequipos', [MapaController::class, 'gimcanaequipos']);
//Ruta para crear un equipo
Route::get('/crearequipo', [MapaController::class, 'crearequipo']);
//Ruta para crear un equipo POST
Route::post('/crearequipoPOST', [MapaController::class, 'crearequipoPOST']);
//Ruta para unirme a un equipo
Route::get('/unirequipo', [MapaController::class, 'unirequipo']);
//Ruta para unirme a un equipo POST
Route::post('/unirequipoPOST', [MapaController::class, 'unirequipoPOST']);
//Jugar a la gimcana desde ser el anifitrion del equipo
Route::get('/jugargimcana', [MapaController::class, 'jugargimcana']);
//Jugar a la gimcana desde unirme al equipo
Route::get('/jugargimcana2', [MapaController::class, 'jugargimcana2']);

// ruta para modificar
Route::put('modificar',[AdministracionController::class, 'modificarController']);
// ruta para eliminar ubicación.
Route::delete('eliminar/{id}', [AdministracionController::class, 'eliminarController']);