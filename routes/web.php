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

Route::get('/', function () {
    return view('principal');
});

//LEER AJAX
// ruta para leer
Route::post('leer',[AdministracionController::class, 'leerController']);
// ruta para insertar/crear
Route::post('crear',[AdministracionController::class, 'crearController']);

Route::post('leertipo',[AdministracionController::class, 'lecturatipoubicacion']);
