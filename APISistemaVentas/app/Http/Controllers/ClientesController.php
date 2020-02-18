<?php

namespace App\Http\Controllers;

use App\models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    public function ListarClientes(){
        $datos = DB::select('SELECT * FROM ViewClientes');
        return response()->json(['Clientes' => $datos]);
    }

    public function RegistrarCliente(Request $request){
        $input = $request->all();
        $datos = new Clientes();
        $datos->nombre = $input['nombre'];
        $datos->apellidop = $input['apellidop'];
        $datos->apellidom = $input['apellidom'];
        $datos->direccion = $input['direccion'];
        $datos->telefono = $input['telefono'];
        $datos->estado = 1;
        $datos->save();
        return response()->json(['Mensaje' => 'Cliente registrado correctamente']);
    }

    public function ActualizarCliente(Request $request, $id){
        $input = $request->all();
        $datos = Clientes::find($id);;
        $datos->nombre = $input['nombre'];
        $datos->apellidop = $input['apellidop'];
        $datos->apellidom = $input['apellidom'];
        $datos->direccion = $input['direccion'];
        $datos->telefono = $input['telefono'];
        $datos->update();
        return response()->json(['Mensaje' => 'Cliente actualizado correctamente']);
    }

    public function EliminarCliente($id){
        $datos = Clientes::find($id);
        $datos->estado = 0;
        $datos->update();
        return response()->json(['Mensaje' => 'Cliente eliminado correctamente']);
    }
}
