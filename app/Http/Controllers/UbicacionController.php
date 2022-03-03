<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mapa_filtro_todo()
    {
        $lista_ubicaciones = DB::table('tbl_churreria')->select('*')->get();
        return $lista_ubicaciones;
        view('mapa_filtros');
    }

}
