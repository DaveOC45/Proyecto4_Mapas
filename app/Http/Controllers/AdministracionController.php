<?php

namespace App\Http\Controllers;

use App\Models\Administracion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdministracionController extends Controller
{
    public function leerController(Request $request){
        $datos=DB::select('SELECT * FROM `tbl_ubicacion` INNER JOIN `tbl_tipo` ON tbl_ubicacion.id_tipo = tbl_tipo.id_tipo where nombre_ubicacion like ?',['%'.$request->input('filtro').'%']);
        return response()->json($datos);
    }
    public function crearController(Request $request){
        $datos = $request->except('_token');
        
        try{
            DB::beginTransaction();
            $path=$request->file('foto_ubicacion')->store('uploads','public');
            $selectid = DB::table('tbl_tipo')->select('id_tipo')->where('nombre_tipo','=',$datos['nombre_tipo'])->first();
            $selectid=$selectid->id_tipo;
            // $id = DB::table('tbl_tipo')->insertGetId(["nombre_tipo"=>$datos['nombre_tipo']]);
            DB::table('tbl_ubicacion')->insertGetId(["nombre_ubicacion"=>$datos['nombre_ubicacion'],"descripcion_ubicacion"=>$datos['descripcion_ubicacion'],"direccion_ubicacion"=>$datos['direccion_ubicacion'],"foto_ubicacion"=>$path,"id_tipo"=>$selectid]);
            DB::commit();
            return response()->json(array('resultado'=> 'OK'));            
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }
    public function lecturatipoubicacion(){
        $listaTipo = DB::table('tbl_tipo')->select('nombre_tipo')->get();
        // return view('principal', compact('listaTipo'));
        return response()->json($listaTipo);;
    }
    public function modificarController(Request $request){
        try {
            DB::update('update tbl_chip set num_serie = ? where id = ?', [$request->input('num_serie'),$request->input('id')]);
            return response()->json(array('resultado'=> 'OK')); 
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        } 
    }   
    public function eliminarController($id){
        try {
            $id = DB::table('tbl_ubicacion')->where('id_ubicacion','=',$id)->delete();
            $id = DB::table('tbl_tipo')->where('id_tipo','=',$id)->delete();
            return response()->json(array('resultado'=> 'OK')); 
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        } 
    }
}
