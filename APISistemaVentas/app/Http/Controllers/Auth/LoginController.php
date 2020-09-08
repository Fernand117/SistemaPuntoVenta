<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $this->validateLogin($request);
        if($this->attemptLogin($request)){
            $user = $this->guard()->user();
            $user->generateToken();
            return response()->json(['user'=>$user->toArray()]);
        }
    }

    public function logout(){
        $user = Auth::guard('api')->user();
        if($user){
            $user->token = null;
            $user->save();
        }
        return response()->json(['Mensaje' => 'Sesión cerrada correctamente', 200]);
    }

    public function LeerToken(Request $request){
        $input = $request->all();
        $token = $input['token'];
        $datos = DB::select('select a.nombre, a.apellidop, a.apellidom, u.email, u.token, u.id from users u, administrador a where u.id = a.userid AND u.token = ?', [$token]);
        return response()->json(['Usuario' => $datos]);
    }

    public function ListaUsuarios() {
        $datos = DB::select('select a.nombre, a.apellidop, a.apellidom, u.email, u.token, u.id from users u, administrador a where u.id = a.userid order by u.id');
        return response()->json(['Usuarios' => $datos]);
    }
}
