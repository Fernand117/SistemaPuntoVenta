<?php

namespace App\Http\Controllers;

use App\models\DetallesRemision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NumeroALetras\NumeroALetras;
use phpDocumentor\Reflection\Types\Integer;

class DetallesRemisionController extends Controller
{
    public function ListarRemision(Request $request)
    {
        $input = $request->all();
        $nremision = $input['numero_remision'];

        $dtremision = DB::select('SELECT * FROM ViewDetallesRemisionDatos WHERE numero_remision = ? limit 1', [$nremision]);

        $datos = DB::select('SELECT * FROM ViewDetallesRemisionRemision WHERE numero_remision = ?', [$nremision]);

        $datositem = json_decode(json_encode($datos), true);
        for ($i = 0; $i < count($datositem); $i++) {
            $datositem[$i]['precio'] = round($datositem[$i]['precio'] / 1.16 * 100)/100;
        }

        $subtotalgr = DB::select('SELECT * FROM ViewSubtotalRemisionDetalles WHERE idremision = ?', [$nremision]);

	$subtotalgeneral = DB::select('SELECT sum(total) as total FROM ViewTotalRemisionesDetalles WHERE idremision = ?', [$nremision]);

        $items = json_decode(json_encode($subtotalgeneral), true);
        for ($i = 0; $i < count($subtotalgeneral); $i++) {
            $items[$i]['total'] = round($items[$i]['total'] * 1.16);
        }
        $formatter = NumeroALetras::convertir($items['0']['total'], 'PESOS');

        $LetrasJson = json_decode(json_encode($formatter), true);

        $sb = json_decode(json_encode($subtotalgr), true);
        $tt = $items['0']['total'];
        $iva = "$".round($tt - $sb['0']['subtotal']);
        return response()->json(['Remisiones' => $datositem, 'Subtotal' => $subtotalgr, 'IVA' => $iva, 'Total' => $items, 'LetrasTotal' => $LetrasJson, 'Detalles' => $dtremision]);
    }

    public function RegistrarDetalleRemision(Request $request)
    {
        $input = $request->all();
        $idproducto = $input['idproducto'];

        $consult = DB::select('select precio from productos where codigo = ?', [$idproducto]);
        $items = json_decode(json_encode($consult), true);

        for($i = 0; $i < count($consult); $i++){
            $items[$i]['precio'] = $items[$i]['precio']/1.16;
        }

        $datos = new DetallesRemision();
        $datos->idremision = $input['idremision'];
        $datos->idcliente = $input['idcliente'];
        $datos->idproducto = $input['idproducto'];
        if ($input['almacen'] == 'general') {
            $datos->almacen_general = $input['almacen'];
        } else {
            $datos->almacen_salida = $input['almacen'];
        }
        $datos->cantidad = $input['cantidad'];
        $cant = $datos->cantidad;
        $price = $items['0']['precio'];
        $price = round($price * 100)/100;
        $datos->subtotal = $price * $cant;
        $datos->estado = 1;
        $datos->save();
        return response()->json(['Mensaje' => 'Producto añadido correctamente']);
    }

    public function EliminarDetalleRemision($id)
    {
        $datos = DB::delete('delete from detalles_remision where idproducto = ?', [$id]);
        return response()->json(['Mensaje' => 'Producto eliminado']);
    }

    public function PruebaProd()
    {
        $i = 5;
        for(;$i < 100;){
            if($i == 60){
                $i = $i + 40;
            }
            echo $i;
            echo ",";
            $i += 5;
        }
    }
}
