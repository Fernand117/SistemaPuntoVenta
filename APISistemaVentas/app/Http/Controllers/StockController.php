<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function Stock()
    {
        $general = DB::select('SELECT a.idproducto, p.nombre, p.descripcion, sum(a.cantidad) as stock FROM almacen_general a, productos p WHERE a.estado = 1 AND a.idproducto = p.codigo group by p.nombre, p.descripcion, a.idproducto');
        $itemGeneral = json_decode(json_encode($general), true);
        $remision = DB::select('select idproducto, sum(cantidad) as cantidad from Detalles_Remision group by idproducto');
        $itemRemision = json_decode(json_encode($remision), true);
        
        $salida = DB::select('select sum(cantidad_retorno) as salida from Almacen_Salida group by idproducto ORDER BY idproducto');
        $itemSalida = json_decode(json_encode($salida), true);
        
        $retorno = DB::select('select sum(cantidad_retorno) as retorno from Almacen_Salida group by idproducto ORDER BY idproducto');
        $itemRetorno = json_decode(json_encode($retorno), true);

        for($i = 0; $i < count($remision); $i++){
            $itemGeneral[$i]['stock'] = ($itemGeneral[$i]['stock'] - $itemRemision[$i]['cantidad']);
        }
        return response()->json(['Stock' => $itemGeneral]);
    }
    
}
