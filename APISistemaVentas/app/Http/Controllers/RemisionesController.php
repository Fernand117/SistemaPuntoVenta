<?php

namespace App\Http\Controllers;

use App\models\Remisiones;
use Hamcrest\Core\HasToString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RemisionesController extends Controller
{
    public function ListarRemisiones(){
        $datos = DB::select('SELECT * FROM remisiones WHERE estado = 1 ORDER BY fecha_remision DESC');
        $items = json_decode(json_encode($datos), true);
        for($i = 0; $i < count($datos); $i++){
            $items[$i]['numero_remision'] = $items[$i]['numero_remision'];
        }
        return response()->json(['Remisiones' => $items]);
    }

    public function RegistrarRemision(Request $request){
        $input = $request->all();
        $datos = new Remisiones();

        $nremision = DB::select('select numero_remision from remisiones where estado = 1 ORDER BY numero_remision DESC LIMIT 1');
        $items = json_decode(json_encode($nremision), true);

        for($i = 0; $i < count($nremision); $i++){
            if($items[$i]['numero_remision'] != null){
                $items[$i]['numero_remision'] = $items[$i]['numero_remision']+1;
            } else {
                $items[$i]['numero_remision'] = "001";
            }
            
        }

        if($items != null){
            $nremisionn = $items['0']['numero_remision'];
        } else {
            $nremisionn = "1";
        }

        $datos->fecha_remision = $input['fecha_remision'];
        $datos->numero_remision = $nremisionn;
        $datos->estado_remision = $input['estado_remision'];
        $datos->descripcion = $input['descripcion'];
        $datos->venta = 0;
        $datos->total = 0;
        $datos->idusuario = $input['idusuario'];
        $datos->estado = 1;
        $datos->save();
        return response()->json(['Mensaje' => 'Remision creada correctamente']);
    }

    public function ActualizarRemision(Request $request){
        $input = $request->all();
        $idrem = $input['idremision'];
        $total = $input['total'];
        $datos = DB::update('UPDATE remisiones set venta = 1, total = ? where numero_remision = ?', [$total,$idrem]);
        return response()->json(['Mensaje' => 'Venta realizada']);
    }

    public function EliminarRemision($id){
        $datos = Remisiones::find($id);
        $datos->estado = 0;
        $datos->update();
        return response()->json(['Mensaje'=>'Remision eliminada correctamente']);
    }

    public function RemisionPrueba(){
        $nremision = DB::select('select numero_remision from remisiones where estado = 1 ORDER BY numero_remision DESC LIMIT 1');
        $items = json_decode(json_encode($nremision), true);
        for($i = 0; $i < count($nremision); $i++){
            $items[$i]['numero_remision'] = "A00".($items[$i]['numero_remision']+1);
        }
        $nremision = $items['0']['numero_remision'];
        return response()->json(['Mensaje' => $items]);
    }
}
