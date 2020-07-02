<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Categorias;
use Illuminate\Support\Facades\DB;

class CategoriasController extends Controller
{
    public function ListarCategorias()
    {
        $datos = DB::select('select * from ViewCategorias');        
        $items = json_decode(json_encode($datos), true);
        for($i=0; $i < count($datos); $i++){
            $items[$i]['imagen'] = 'http://'.$_SERVER['SERVER_NAME'].':8000/img/categorias/'.$items[$i]['imagen'];
        }
        return response()->json(['categorias' => $items]);
    }

    public function RegistrarCategoria(Request $request)
    {
        $input = $request->all();
        $extension = $request->file('imagen')->getClientOriginalExtension();
        $path = base_path().'/public/img/categorias/';
        $name = "imagen_".date('Y_m_d_h_i_s').".".$extension;
        $request->file("imagen")->move($path,$name);
        $datos = new Categorias();
        $datos->imagen = $name;
        $datos->nombre = $input['nombre'];
        $datos->estado = 1;
        $datos->save();
        return response()->json(['Mensaje'=>'Categoria almacenada correctamente']);
    }

    public function ActualizarCategoria(Request $request, $id){
        $input = $request->all();
        $datos = Categorias::find($id);
        if(isset($input['imagen'])){
            $extension = $request->file('imagen')->getClientOriginalExtension();
            $path = base_path().'/public/img/categorias/';
            $name = "imagen_".date('Y_m_d_h_i_s').".".$extension;
            $request->file("imagen")->move($path, $name);
            $datos->imagen = $name;
        }
        $datos->nombre = $input['nombre'];
        $datos->update();
        return response()->json(['Mensaje'=>'La categoría se ha actualizado correctamente']);
    }

    public function EliminarCategoria($id){
        $datos = Categorias::find($id);
        $datos->estado = 0;
        $datos->update();
        return response()->json(['Mensaje'=>'Categoria eliminada correctamente']);
    }
}
