<?php

namespace App\Http\Controllers;

use App\models\Remisiones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RemisionesController extends Controller
{
    public function ListarRemisiones(){
        $datos = DB::select('SELECT * FROM remisiones WHERE estado = 1 ORDER BY fecha_remision DESC');
        return response()->json(['Remisiones' => $datos]);
    }

    public function RegistrarRemision(Request $request){
        $input = $request->all();
        $datos = new Remisiones();
        $datos->fecha_remision = $input['fecha_remision'];
        $datos->numero_remision = $input['numero_remision'];
        $datos->estado_remision = $input['estado_remision'];
        $datos->descripcion = $input['descripcion'];
        $datos->venta = 0;
        $datos->total = 0;
        $datos->idusuario = 1;
        $datos->estado = 1;
        $datos->save();
        return response()->json(['Mensaje' => 'Remision creada correctamente']);
    }

    public function ActualizarRemision(Request $request){
        $input = $request->all();
        $id = $input['id'];
        $datos = Remisiones::find($id);
        $datos->venta = 1;
        $datos->total = $input['total'];
        $datos->update();
        return response()->json(['Mensaje' => 'Remision actualizada correctamente']);
    }

    public function EliminarRemision($id){
        $datos = Remisiones::find($id);
        $datos->estado = 0;
        $datos->update();
        return response()->json(['Mensaje'=>'Remision eliminada correctamente']);
    }
}
