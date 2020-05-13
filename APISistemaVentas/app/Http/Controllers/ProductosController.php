<?php

namespace App\Http\Controllers;

use App\models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductosController extends Controller
{
    public function ProductosDetalles(Request $request){
        $input = $request->all();
        $codigo_producto = $input['codigo'];
        $datos = DB::select('SELECT * FROM ViewProductos WHERE codigo = ?', [$codigo_producto]);
        $items = json_decode(json_encode($datos), true);
        for($i=0; $i < count($datos); $i++){
            $items[$i]['imagen'] = 'http://'.$_SERVER['SERVER_NAME'].':8000/img/productos/'.$items[$i]['imagen'];
        }
        return response()->json(['Productos' => $items]);
    }

    public function ListProductsGeneral(){
        $datos = DB::select('select * from ViewProductos');
        $items = json_decode(json_encode($datos), true);
        for($i=0; $i < count($datos); $i++){
            $items[$i]['imagen'] = 'http://'.$_SERVER['SERVER_NAME'].':8000/img/productos/'.$items[$i]['imagen'];
        }
        return response()->json(['Productos' => $items]);
    }

    public function ListarProductos($id){
        $subcategoria = DB::select('select * from ViewProductos where subcategoria = ?', [$id]);
        $categoria = DB::select('select * from ViewProductos where categoria = ?', [$id]);
	$marca = DB::select('select * from ViewProductos where marca = ?', [$id]);
	$provedor = DB::select('select * from ViewProductos where provedor = ?', [$id]);
        
        if($subcategoria != null){
            $datos = $subcategoria;
        } elseif($categoria != null){
            $datos = $categoria;
        } elseif($marca != null){
            $datos = $marca;
        } else {
            $datos = $provedor;
        }

        $items = json_decode(json_encode($datos), true);
        
        for($i=0; $i < count($datos); $i++){
            $items[$i]['imagen'] = 'http://'.$_SERVER['SERVER_NAME'].':8000/img/productos/'.$items[$i]['imagen'];
        }
        
        return response()->json(['Productos' => $items]);
    }

    public function RegistrarProducto(Request $request){
        $input = $request->all();
        $datos = new Productos();
        if(isset($input['imagen'])){
            $extension = $request->file('imagen')->getClientOriginalExtension();
            $path = base_path().'/public/img/productos/';
            $name = "imagen_".date('Y_m_d_h_i_s').".".$extension;
            $request->file("imagen")->move($path, $name);
            $datos->imagen = $name;
        }
        $datos->codigo = $input['codigo'];
        $datos->nombre = $input['nombre'];
        $datos->descripcion = $input['descripcion'];
        $datos->idcategoria = $input['idcategoria'];
        $datos->idsubcategoria = $input['idsubcategoria'];
        $datos->idmarca = $input['idmarca'];
        $datos->idprovedor = $input['idprovedor'];
        $datos->precio = $input['precio'];
        $datos->estado = 1;
        $datos->save();
        return response()->json(['Mensaje' => 'Producto almacenado correctamente']);
    }

    public function ActualizarProducto($id, Request $request){
        $input = $request->all();
        $datos = Productos::find($id);
        if(isset($input['imagen'])){
            $extension = $request->file('imagen')->getClientOriginalExtension();
            $path = base_path().'/public/img/productos/';
            $name = "imagen_".date('Y_m_d_h_i_s').".".$extension;
            $request->file("imagen")->move($path, $name);
            $datos->imagen = $name;
        }

        if(isset($input['codigo'])){
            $datos->codigo = $input['codigo'];
            $datos->update();
        }

        if(isset($input['nombre'])){
            $datos->nombre = $input['nombre'];
            $datos->update();
        }

        if(isset($input['descripcion'])){
            $datos->descripcion = $input['descripcion'];
            $datos->update();
        }

        if(isset($input['idcategoria'])){
            $datos->idcategoria = $input['idcategoria'];
            $datos->update();
        }

        if(isset($input['idsubcategoria'])){
            $datos->idsubcategoria = $input['idsubcategoria'];
            $datos->update();
        }

        if(isset($input['idmarca'])){
            $datos->idmarca = $input['idmarca'];
            $datos->update();
        }

        if(isset($input['idprovedor'])){
            $datos->idprovedor = $input['idprovedor'];
            $datos->update();
        }

        if(isset($input['precio'])){
            $datos->precio = $input['precio'];
            $datos->update();
        }
        
        return response()->json(['Mensaje' => "Producto actualizado correctamente"]);
    }

    public function EliminarProducto($id){
        $datos = Productos::find($id);
        $datos->estado = 0;
        $datos->update();
        return response()->json(['Mensaje'=>'Producto eliminado correctamente']);
    }

    public function TotalProductosRegistrados(){
        $datos = DB::select('SELECT * FROM TotalProductosRegistrados');
        return response()->json(['Total' => $datos]);
        
    }
}
