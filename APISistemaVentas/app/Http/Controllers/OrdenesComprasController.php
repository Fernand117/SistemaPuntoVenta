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
        $datos->nombre_producto = $input['nombreproducto'];
        $datos->cantidad = $input['cantidad'];
        $datos->fecha_entrega = $input['fechaentrega'];
        $datos->idprovedor = $input['idprovedor'];
        $datos->estado = 1;
        $datos->save();
        return response()->json(['Mensaje' => 'Orden de compra registrada correctamente']);
    }

    public function ActualizarOrdenCompra(Request $request, $id)
    {
        $input = $request->all();
        $datos = OrdenesCompras::find($id);
        $datos->nombre_producto = $input['nombreproducto'];
        $datos->cantidad = $input['cantidad'];
        $datos->fecha_entrega = $input['fechaentrega'];
        $datos->idprovedor = $input['idprovedor'];
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
