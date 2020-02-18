<?php

namespace App\Http\Controllers;

use App\models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller
{
    public function ValidateUser(Request $request)
    {
        $input = $request->all();
        $user = $input['usuario'];
        $psw = $input['clave'];
        $datos = DB::select('SELECT * FROM LoginView WHERE username = ? AND clave = ?', [$user, $psw]);
        return response()->json(['Usuario' => $datos]);
    }

    public function RegistrarUsuario(Request $request){
        $input = $request->all();
        $datos = new Usuarios();
        $datos->nombre = $input['nombre'];
        $datos->apellidop = $input['apellidop'];
        $datos->apellidom = $input['apellidom'];
        $datos->username = $input['username'];
        $datos->clave = $input['clave'];
        $datos->estado = 1;
        $datos->save();
        return response()->json(['Mensaje' => 'Usuario registrado correctamente']);
    }

    public function ActualizarUsuario(Request $request, $id)
    {
        $input = $request->all();
        $datos = Usuarios::find($id);
        $datos->nombre = $input['nombre'];
        $datos->apellidop = $input['apellidop'];
        $datos->apellidom = $input['apellidom'];
        $datos->username = $input['username'];
        $datos->clave = $input['clave'];
        $datos->update();
        return response()->json(['Mensaje' => 'Usuario actualizado correctamente']);
    }

    public function EliminarUsuario($id)
    {
        $datos = Usuarios::find($id);
        $datos->estado = 0;
        $datos->update();
        return response()->json(['Mensaje' => 'Usuario eliminado correctamente']);
    }
}
