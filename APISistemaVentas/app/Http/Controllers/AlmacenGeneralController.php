<?php

namespace App\Http\Controllers;

use App\models\AlmacenGeneral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlmacenGeneralController extends Controller
{
    public function ListarAlmacen()
    {
        $datos = DB::select('SELECT * FROM ViewAlmacen');
        return response()->json(['Almacen' => $datos]);
    }

    public function ListarAlmacenFecha(Request $request){
        $input = $request->all();
        $fecha = $input['fecha'];
        $datos = DB::select('SELECT * FROM ViewAlmacen WHERE fecha_ingreso = ?', [$fecha]);
        return response()->json(['AlmacenFecha' => $datos]);
    }

    public function Store(Request $request)
    {
        $input = $request->all();
        $datos = new AlmacenGeneral();
        $datos->idproducto = $input['idproducto'];
        $datos->cantidad = $input['cantidad'];
        $datos->fecha_ingreso = $input['fechaingreso'];
        $datos->estado = 1;
        $datos->save();
        return response()->json(['Mensaje' => 'Registro almacenado correctamente']);
    }
}
