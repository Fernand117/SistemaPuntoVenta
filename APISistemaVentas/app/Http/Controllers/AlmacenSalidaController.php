<?php

namespace App\Http\Controllers;

use App\models\AlmacenSalida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlmacenSalidaController extends Controller
{

    public function ListarSalidas()
    {
        $datos = DB::select('SELECT * FROM ViewSalidas');
        return response()->json(['Salidas' => $datos]);
    }

    public function RegistrarSalida(Request $request)
    {
        $input = $request->all();
        $datos = new AlmacenSalida();
        $datos->idproducto = $input['idproducto'];
        $datos->cantidad_salida = $input['cantidadsalida'];
        $datos->cantidad_retorno = $input['cantidadretorno'];
        $datos->numero_unidad = $input['numerounidad'];
        $datos->fecha_salida = $input['fechasalida'];
        $datos->estado = 1;
        $datos->save();
        return response()->json(['Mensaje' => 'Salida registrada correctamente']);
    }

    public function ActualizarSalida(Request $request, $id)
    {
        $input = $request->all();
        $datos = AlmacenSalida::find($id);
        $datos->cantidad_retonro = $input['cantidadretorno'];
        $datos->update();
        return response()->json(['Mensaje' => 'Cantidad de retorno ingresada correctamente']);
    }
}
