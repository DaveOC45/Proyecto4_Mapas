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

//---------- ECOSISTEMA DE LOS MAPAS PARTE ALVAREZ------------//
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


/*ECOSISTEMA DEL ADMIN ORTEGA*/
/*UNIRSE UN EQUIPO*/
Route::get('unirseequipo',[AdministracionController::class, 'unirseequipo']);
Route::post('unirsePostequipo',[AdministracionController::class, 'unirsePostequipo']);
/*REGISTRO DE EQUIPO*/
Route::get('registroequipo',[AdministracionController::class, 'registroequipo']);
Route::post('registroPostequipo',[AdministracionController::class, 'registroPostequipo']);
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