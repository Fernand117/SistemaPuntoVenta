<?php

namespace App\Http\Controllers;

use App\models\DetallesRemision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NumeroALetras\NumeroALetras;

class DetallesRemisionController extends Controller
{
    public function ListarRemision(Request $request){
        $input = $request->all();
        $nremision = $input['numero_remision'];

        $dtremision = 
        DB::select('SELECT * FROM ViewDetallesRemisionDatos WHERE numero_remision = ?', [$nremision]);

        $datos = DB::select('SELECT * FROM ViewDetallesRemisionRemision WHERE venta = 1 and numero_remision = ?', [$nremision]);
        $subtotalgr = DB::select('SELECT * FROM ViewSubtotalRemisionDetalles WHERE idremision = ?', [$nremision]);
        $subtotalgeneral = DB::select('SELECT * FROM ViewTotalRemisionesDetalles WHERE idremision = ?', [$nremision]);
        $items = json_decode(json_encode($subtotalgeneral), true);
        for($i=0; $i < count($subtotalgeneral); $i++){
            $items[$i]['total'] = $items[$i]['total'] + ($items[$i]['total'] * .16);
        }
        $formatter = NumeroALetras::convertir($items['0']['total'], 'PESOS');

        $LetrasJson = json_decode(json_encode($formatter), true);

        return response()->json(['Remisiones' => $datos,'Subtotal' => $subtotalgr ,'Total' => $items,'LetrasTotal' => $LetrasJson,'Detalles' => $dtremision]);
    }

    public function RegistrarDetalleRemision(Request $request){
        $input = $request->all();
        $datos = new DetallesRemision();
        $datos->idremision = $input['idremision'];
        $datos->idcliente = $input['idcliente'];
        $datos->idproducto = $input['idproducto'];
        if($input['almacen'] == 'general'){
            $datos->almacen_general = $input['almacen'];
        }else{
            $datos->almacen_salida = $input['almacen'];
        }
        $datos->cantidad = $input['cantidad'];
        /**
         * Validar que el stock actual del producto sea mayor a la cantidad que se está ingresando
         * de lo contrario, no podrá registrarlo
         */
        $cant = $datos->cantidad;
        $price = $input['precio'];
        $datos->subtotal = $price * $cant;
        $datos->estado = 1;
        $datos->save();
        return response()->json(['Mensaje' => 'Producto añadido correctamente']);
    }

    public function EliminarDetalleRemision($id){
        $datos = DB::delete('delete from detalles_remision where idproducto = ?', [$id]);
        return response()->json(['Mensaje' => 'Producto eliminado']);
    }
}
