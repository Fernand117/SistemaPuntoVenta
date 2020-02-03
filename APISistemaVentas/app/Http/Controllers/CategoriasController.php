<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Categorias;

class CategoriasController extends Controller
{
    public function ListarCategorias()
    {
        $datos = Categorias::all();
        return response()->json(['categorias' => $datos]);
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
        $datos->save();
        return response()->json(['Mensaje'=>'Categoria almacenada correctamente']);
    }
}
