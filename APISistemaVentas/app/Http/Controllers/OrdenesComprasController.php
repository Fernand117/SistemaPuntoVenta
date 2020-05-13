<?php

namespace App\Http\Controllers;

use App\models\OrdenesCompras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdenesComprasController extends Controller
{
    public function ListarOrdenesCompras(){
        $datos = DB::select('SELECT * FROM ViewOrdenesCompras');
        return response()->json(['OrdenesCompras' => $datos]);
    }

    public function RegistrarOrdenCompra(Request $request){
        $input = $request->all();
        $datos = new OrdenesCompras();
        $datos->remision_compra = $input["remision_compra"];
        $datos->fecha_entrega = $input["fecha_entrega"];
        $datos->idprovedor = $input["idprovedor"];
        $datos->estado = 1;
        $datos->save();
        return response()->json(['Mensaje' => 'Orden de compra registrada correctamente']);
    }

    public function ActualizarOrdenCompra(Request $request, $id)
    {
        $input = $request->all();
        $datos = OrdenesCompras::find($id);
        $datos->remision_compra = $input["remision_compra"];
        $datos->fecha_entrega = $input["fecha_entrega"];
        $datos->idprovedor = $input["idprovedor"];
        $datos->update();
        return response()->json(['Mensaje' => 'Orden de compra actualizada correctamente']);
    }

    public function EliminarOrdenCompra($id)
    {
        $datos = OrdenesCompras::find($id);
        $datos->estado = 0;
        $datos->update();
        return response()->json(['Mensaje' => 'Orden de compra eliminada correctamente']);
    }

    public function TotalOrdenesCompras(){
        $datos = DB::select('SELECT COUNT(*) FROM ViewOrdenesCompras');
        return response()->json(['Total' => $datos]);
    }
}
