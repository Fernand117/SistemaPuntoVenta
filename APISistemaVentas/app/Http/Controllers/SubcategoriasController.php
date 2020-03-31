<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Subcategorias;
use Illuminate\Support\Facades\DB;

class SubcategoriasController extends Controller
{
    public function ListarSubcategorias(){
        $datos = DB::select('SELECT * FROM ViewSubcategorias');
        $items = json_decode(json_encode($datos), true);
        for($i=0; $i < count($datos); $i++){
            $items[$i]['imagen'] = 'http://'.$_SERVER['SERVER_NAME'].'/img/categorias/'.$items[$i]['imagen'];
        }
        return response()->json(['SubCategorias' => $items]);
    }

    public function RegistrarSubcategoria(Request $request){
        $input = $request->all();
        $extension = $request->file('imagen')->getClientOriginalExtension();
        $path = base_path().'/public/img/subcategorias/';
        $name = "imagen_".date('Y_m_d_h_i_s').".".$extension;
        $request->file("imagen")->move($path, $name);
        $datos = new Subcategorias();
        $datos->imagen = $name;
        $datos->nombre = $input['nombre'];
        $datos->idcategoria = $input['idcategoria'];
        $datos->save();
        return response()->json(['Mensaje' => 'Subcategoria almacenada correctamente']);
    }

    public function ActualizarSubcategorias(Request $request, $id){
        $input = $request->all();
        $datos = Subcategorias::find($id);
        if(isset($input['imagen'])){
            $extension = $request->file('imagen')->getClientOriginalExtension();
            $path = base_path().'/public/img/subcategorias/';
            $name = "imagen_".date('Y_m_d_h_i_s').".".$extension;
            $request->file("imagen")->move($path, $name);
            $datos->imagen = $name;
        }
        $datos->nombre = $input['nombre'];
        $datos->idcategoria = $input['idcategoria'];
        $datos->update();
        return response()->json(['Mensaje'=>'Subcategoria acutalizada correctamente']);
    }

    public function EliminarSubcategoria($id){
        $datos = Subcategorias::find($id);
        $datos->delete();
        return response()->json(['Mensaje'=>'Subcategoria eliminada correctamente']);
    }
}