<?php

namespace App\Http\Controllers;

use App\models\Provedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvedoresController extends Controller
{
    public function ListarProvedores(){
        $datos = DB::select('SELECT * FROM ViewProvedores');
        return response()->json(['Provedores' => $datos]);
    }

    public function RegistrarProvedor(Request $request){
        $input = $request->all();
        $datos = new Provedores();
        $datos->nombre = $input['nombre'];
        $datos->direccion = $input['direccion'];
        $datos->telefono = $input['telefono'];
        $datos->save();
        return response()->json(['Mensaje' => 'Provedor registrado correctamente']);
    }

    public function ActualizarProvedor(Request $request, $id){
        $input = $request->all();
        $datos =  Provedores::find($id);
        $datos->nombre = $input['nombre'];
        $datos->direccion = $input['direccion'];
        $datos->telefono = $input['telefono'];
        $datos->update();
        return response()->json(['Mensaje' => 'Provedor actualizado correctamente']);
    }

    public function EliminarProvedor($id){
        $datos = Provedores::find($id);
        $datos->delete();
        return response()->json(['Mensaje' => 'Provedor eliminado correctamente']);
    }
}
