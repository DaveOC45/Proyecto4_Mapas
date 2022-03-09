<?php

namespace App\Http\Controllers;

use App\Models\Administracion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\storage;
use Illuminate\Http\Request;

class AdministracionController extends Controller
{
    /*----------------------------------------LOGIN Y LOGOUT------------------------------------------------------------------------*/
    public function loginP(Request $request){
        $datos= $request->except('_token','_method');
        $user=DB::table("tbl_rol")->join('tbl_usuario', 'tbl_rol.id_rol', '=', 'tbl_usuario.id_rol')->where('correo_usuario','=',$datos['correo_usuario'])->where('password_usuario','=',$datos['password_usuario'])->first();
        if($user->nombre_rol=='administrador'){
           $request->session()->put('nombre_admin',$request->correo_usuario);
           return redirect('cPanelAdmin');
        }if($user->nombre_rol=='usuario'){
            $request->session()->put('nombre_user',$request->correo_usuario);
            return redirect('');
        }
        return redirect('');
    }
    public function logout(Request $request){
        $request->session()->forget('nombre_admin');
        $request->session()->forget('nombre_user');
        $request->session()->flush();
        return redirect('');
    }
    /*----------------------------------------FIN LOGIN Y LOGOUT------------------------------------------------------------------------*/
    
    //---------------------------------------------AJAX DE RESTAURANTE--------------------------------------------------------------------------
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
        $datos=$request->except('_token','_method');
        if ($request->hasFile('foto_ubicacion')) {
            $foto = DB::table('tbl_ubicacion')->select('foto_ubicacion')->where('id_ubicacion','=',$request['id_ubicacion'])->first();
            if ($foto->foto_ubicacion != null) {
                Storage::delete('public/'.$foto->foto_ubicacion);
            }
            $datos['foto_ubicacion'] = $request->file('foto_ubicacion')->store('uploads','public');
        }else{
            $foto = DB::table('tbl_ubicacion')->select('foto_ubicacion')->where('id_ubicacion','=',$request['id_ubicacion'])->first();
            $datos['foto_ubicacion'] = $foto->foto_ubicacion;
        }
        try {
            DB::beginTransaction();
            $path=$request->file('foto_ubicacion')->store('uploads','public');
            DB::update('update tbl_ubicacion set nombre_ubicacion = ?, descripcion_ubicacion = ?, direccion_ubicacion = ?, foto_ubicacion = ? where id_ubicacion = ?', [$request->input('nombre_ubicacion'),$request->input('descripcion_ubicacion'),$request->input('direccion_ubicacion'),$path,$request->input('id_ubicacion')]);
            DB::commit();
            return response()->json(array('resultado'=> 'OK')); 
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        } 
    }   
    public function eliminarController($id){
        try {
            $id = DB::table('tbl_ubicacion')->where('id_ubicacion','=',$id)->delete();
            return response()->json(array('resultado'=> 'OK')); 
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        } 
    }
        //------------------------------------------FIN AJAX DE RESTAURANTE------------------------------------------------------------
        
        //------------------------------------------AJAX USUARIOS----------------------------------------------------------------------
    public function leerControlleruser(Request $request){
        $datos=DB::select('SELECT * FROM `tbl_usuario` INNER JOIN `tbl_rol` ON tbl_usuario.id_rol = tbl_rol.id_rol where nombre_usuario like ?',['%'.$request->input('filtro').'%']);
        return response()->json($datos);
    }
    public function crearControlleruser(Request $request){
        $datos = $request->except('_token');
        
        try{
            DB::beginTransaction();
            $selectid = DB::table('tbl_rol')->select('id_rol')->where('nombre_rol','=',$datos['nombre_rol'])->first();
            $selectid=$selectid->id_rol;
            // $id = DB::table('tbl_tipo')->insertGetId(["nombre_tipo"=>$datos['nombre_tipo']]);
            DB::table('tbl_usuario')->insertGetId(["nombre_usuario"=>$datos['nombre_usuario'],"apellido_usuario"=>$datos['apellido_usuario'],"correo_usuario"=>$datos['correo_usuario'],"password_usuario"=>$datos['password_usuario'],"id_rol"=>$selectid]);
            DB::commit();
            return response()->json(array('resultado'=> 'OK'));            
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }
    public function lecturatipoubicacionuser(){
        $listaTipo = DB::table('tbl_rol')->select('nombre_rol')->get();
        // return view('principal', compact('listaTipo'));
        return response()->json($listaTipo);;
    }
    public function eliminarControlleruser($id){
        try {
            $id = DB::table('tbl_usuario')->where('id_usuario','=',$id)->delete();
            return response()->json(array('resultado'=> 'OK')); 
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        } 
    }
    public function modificarControlleruser(Request $request){
        try {
            DB::beginTransaction();
            DB::update('update tbl_usuario set nombre_usuario = ?, apellido_usuario = ?, correo_usuario = ?, password_usuario = ? where id_usuario = ?', [$request->input('nombre_usuario'),$request->input('apellido_usuario'),$request->input('correo_usuario'),$request->input('password_usuario'),$request->input('id_usuario')]);
            DB::commit();
            return response()->json(array('resultado'=> 'OK')); 
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        } 
    }   
    
}
