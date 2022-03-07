<?php

use App\Http\Controllers\UbicacionController;
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

Route::get('/mapa', function () {
    return view('mapa_filtros/mapa_filtros');
});

Route::get('/mapa_filtros_todo', [UbicacionController::class, 'mapa_filtro_todo']);
Route::get('/mostrar_tags_ubicaciones', [UbicacionController::class, 'mostrar_tags_ubicaciones']);
Route::get('/mapa_filtros/{tipo}', [UbicacionController::class, 'mapa_filtro_tag']);
Route::get('/id_nombre_ubicacion/{tipo}', [UbicacionController::class, 'id_nombre_ubicacion']);
