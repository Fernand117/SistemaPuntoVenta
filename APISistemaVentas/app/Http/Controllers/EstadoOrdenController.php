<?php

namespace App\Http\Controllers;

use App\models\EstadoOrden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadoOrdenController extends Controller
{
    public function ListarEstados(){
        $datos = DB::select('SELECT * FROM ViewVentasEstado');
        return response()->json(['Estado' => $datos]);
    }

    public function RegistrarEstadoOrden(Request $request){
        $input = $request->all();
        $datos = new EstadoOrden();
        $datos->estado = $input['estado'];
        $datos->save();
        return response()->json(['Mensaje' => 'Estado de orden registrado correctamente']);
    }

    public function ActualizarEstadoOrden(Request $request, $id){
        $input = $request->all();
        $datos = EstadoOrden::find($id);
        $datos->estado = $input['estado'];
        $datos->update();
        return response()->json(['Mensaje' => 'Estado de orden actualizado correctamente']);
    }

    public function EliminarEstadoOrden($id){
        $datos = EstadoOrden::find($id);
        $datos->delete();
        return response()->json(['Mensaje' => 'Estado de orden eliminado correctamente']);
    }
}
