<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['only' => 'formulario']);
    }
    public function formulario()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        //validaciones
        $datos = $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string',
        ]);

        $respuesta = Auth::attempt($datos); //compara los datos con la bd

        if ($respuesta) {
            return redirect()->route('parqueadero.index');
        } else {
            return back()->withErrors(["datos" => "Credenciales no concuerdan"])
                ->withInput(request(['email']));
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
