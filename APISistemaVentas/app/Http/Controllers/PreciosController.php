<?php

namespace App\Http\Controllers;

use App\models\Precios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PreciosController extends Controller
{
    public function ListarPrecios(){
        $datos = DB::select('SELECT * FROM ViewPrecios');
        return response()->json(['Precios' => $datos]);
    }

    public function RegistrarPrecio(Request $request){
        $input = $request->all();
        $datos = new Precios();
        $datos->tipo = $input['tipo'];
        $datos->precio = $input['precio'];
        $datos->idproducto = $input['codigo'];
        $datos->save();
        return response()->json(['Mensaje' => 'Precio registrado correctamente']);
    }

    public function ActualizarPrecio(Request $request, $id){
        $input = $request->all();
        $datos = Precios::find($id);
        $datos->tipo = $input['tipo'];
        $datos->precio = $input['precio'];
        $datos->idproducto = $input['codigo'];
        $datos->update();
        return response()->json(['Mensaje' => 'El precio se ha actualizado correctamente']);
    }

    public function EliminarPrecio($id){
        $datos = Precios::find($id);
        $datos->delete();
        return response()->json(['Mensaje' => 'Precio eliminado correctamente']);
    }
}
