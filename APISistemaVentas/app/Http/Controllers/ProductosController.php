<?php

namespace App\Http\Controllers;

use App\models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductosController extends Controller
{
    public function GuardarProducto(Request $request){
        $input = $request->all();
        $extension = $request->file('imagen')->getClientOriginalExtension();
        $path = base_path().'/public/img/productos/';
        $name = "imagen_".date('Y_m_d_h_i_s').".".$extension;
        $request->file("imagen")->move($path,$name);
        $datos = new Productos();
        $datos->imagen = $name;
        $datos->nombre = $input['nombre'];
        $datos->descripcion = $input['descripcion'];
        $datos->stock = $input['stock'];
        $datos->idcategoria = $input['idcategoria'];
        $datos->idmarca = $input['idmarca'];
        $datos->idprovedor = $input['idprovedor'];
        $datos->save();
        return response()->json(['Mensaje' => 'Producto almacenado correctamente']);
    }

    public function EditarProducto(Request $request, $id){
        $input = $request->all();
        $datos = Productos::find($id);
        if(isset($input['imagen'])){
            $extension = $request->file('imagen')->getClientOriginalExtension();
            $path = base_path().'/public/img/productos/';
            $name = "imagen_".date('Y_m_d_h_i_s').".".$extension;
            $request->file("imagen")->move($path,$name);
            $datos->imagen = $name;
        }
        $datos->nombre = $input['nombre'];
        $datos->descripcion = $input['descripcion'];
        $datos->stock = $input['stock'];
        $datos->idcategoria = $input['idcategoria'];
        $datos->idmarca = $input['idmarca'];
        $datos->idprovedor = $input['idprovedor'];
        $datos->update();
        return response()->json(['Mensaje' => 'Producto actualizado correctamente']);
    }

    public function EliminarProducto($id)
    {
        $datos = Productos::find($id);
        $datos->delete();
        return response()->json(['Mensaje' => 'Producto eliminado correctamente']);
    }
}
