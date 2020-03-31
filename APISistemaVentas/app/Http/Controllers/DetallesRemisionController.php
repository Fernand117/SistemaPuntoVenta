<?php

namespace App\Http\Controllers;

use App\models\DetallesRemision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetallesRemisionController extends Controller
{
    public function ListarRemision(Request $request){
        $input = $request->all();
        $nremision = $input['numero_remision'];
        $datos = DB::select('select r.numero_remision, r.fecha_remision, r.estado_remision, r.descripcion, r.venta, r.total, d.almacen_general, d.almacen_salida, d.cantidad, d.subtotal,c.nombre as cliente, p.codigo, p.nombre as producto from detalles_remision d, clientes c, productos p, remisiones r where d.idremision = r.numero_remision and d.idproducto = p.codigo and d.idcliente = c.id and r.numero_remision = ?', [$nremision]);
        $subtotalgr = DB::select('select SUM(subtotal) as Subtotal from detalles_remision where idremision = ?', [$nremision]);
        $subtotalgeneral = DB::select('select SUM(subtotal) as Total from detalles_remision where idremision = ?', [$nremision]);
        $items = json_decode(json_encode($subtotalgeneral), true);
        for($i=0; $i < count($subtotalgeneral); $i++){
            $items[$i]['total'] = $items[$i]['total'] + ($items[$i]['total'] * .16);
        }
        return response()->json(['Remisiones' => $datos,'Subtotal' => $subtotalgr ,'Total' => $items]);
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
        $cant = $datos->cantidad;
        $price = $input['precio'];
        $datos->subtotal = $price * $cant;
        $datos->estado = 1;
        $datos->save();
        return response()->json(['Mensaje' => 'Producto añadido correctamente']);
    }
}
