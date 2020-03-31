<?php

namespace App\Http\Controllers;

use App\models\Marcas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarcasController extends Controller
{
    public function ListarMarcas(){
        $datos = DB::select('SELECT * FROM ViewMarcas');
        $items = json_decode(json_encode($datos), true);
        for($i=0; $i < count($datos); $i++){
            $items[$i]['imagen'] = 'http://'.$_SERVER['SERVER_NAME'].':8000/img/marcas/'.$items[$i]['imagen'];
        }
        return response()->json(['Marcas' => $items]);
    }

    public function RegistrarMarca(Request $request){
        $input = $request->all();
            $extension = $request->file('imagen')->getClientOriginalExtension();
            $path = base_path().'/public/img/marcas/';
            $name = "imagen_".date('Y_m_d_h_i_s').".".$extension;
            $request->file("imagen")->move($path, $name);
        DB::transaction(function () use($name, $input) {
            $datos = new Marcas();
            $datos->imagen = $name;
            $datos->nombre = $input['nombre'];
            $datos->estado = 1;
            $datos->save();
        });
        return response()->json(['Mensaje' => 'Marca almacenada correctamente']);
    }

    public function ActualizarMarca(Request $request, $id){
        $input = $request->all();
        $datos = Marcas::find($id);
        if(isset($input['imagen'])){
            $extension = $request->file('imagen')->getClientOriginalExtension();
            $path = base_path().'/public/img/marcas/';
            $name = "imagen_".date('Y_m_d_h_i_s').".".$extension;
            $request->file("imagen")->move($path, $name);
            $datos->imagen = $name;
        }
        $datos->nombre = $input['nombre'];
        $datos->update();
        return response()->json(['Mensaje'=>'Marca acutalizada correctamente']);
    }

    public function EliminarMarca($id){
        $datos = Marcas::find($id);
        $datos->estado = 0;
        $datos->update();
        return response()->json(['Mensaje' => 'Marca eliminada correctamente']);
    }
}
