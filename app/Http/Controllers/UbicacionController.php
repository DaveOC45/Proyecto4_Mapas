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
        $lista_ubicaciones = DB::table('tbl_ubicacion')->select('*')->get();
        return $lista_ubicaciones;
    }
    public function mostrar_tags_ubicaciones(){
        $lista_tags=DB::table('tbl_tipo')->select('nombre_tipo')->groupBy('nombre_tipo')->get();
        return $lista_tags;
    }
    public function mapa_filtro_tag($tipo){
        try {
            DB::beginTransaction();
            $id_tipo = DB::table('tbl_tipo')->select('id_tipo')->where('nombre_tipo','=',$tipo)->first();
            //return $id_tipo;
            $lista_ubicaciones_tag = DB::table('tbl_ubicacion')->select('*')->where('id_tipo','=',$id_tipo->id_tipo)->get();
            DB::commit();
            return $lista_ubicaciones_tag;
        } catch (\Exception $error) {
            DB::rollback();
            return $error -> getMessage();
        }
        
        
    }

}
