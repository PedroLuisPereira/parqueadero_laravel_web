<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;


class CuentaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();

        $data = array(
            'usuario' => $user,

        );

        return view('cuenta', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios_crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validaciones
        $validacion = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required|max:255',
            'rol' => 'required|max:255',
        ]);

        //capturar datos 
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $rol = $request->input('rol');

        //crear User 
        $User = new User;
        $User->name = $name;
        $User->email = $email;
        $User->password = Hash::make($password);
        $User->rol = $rol;
        $User->estado = "Activo";
        $User->save();

        return back()->with('respuesta', 'Usuario creado'); //mensaje flask
    }

    public function store_img(Request $request)
    {
        
        //validaciones
        $validacion = $request->validate([
            'avatar' => 'required|image|max:2000',
        ]);

        //buscar usuario
        $id = Auth::user()->id;
        $user = User::findOrFail($id);

        //eliminar foto del servidor 
        Storage::delete($user->foto);

        //guardar nueva foto
        $foto = $request->file('avatar')->store('avatars', 'public');

        //guardar en bd
        $user->foto = $foto;
        $user->save();

        //respuesta
        return back()->with('avatar', 'Avatar actualizado'); //mensaje flask
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $User) //route model binding
    {
        return $User;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
       
        // $usuarios = User::findOrFail($id);
        // $data = array(
        //     'usuario' => $usuarios
        // );

        // return view('usuarios_editar', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $id =  $user->id;

        //validaciones
        $validacion = $request->validate([
             'password' => 'required|max:255',
             'confirmar_password' => 'required|max:255',
        ]);

        //capturar datos 
        $password = $request->input('password');
        $confirmar_password = $request->input('confirmar_password');

        //guardar
        $User = User::findOrFail($id);
        $User->password =  Hash::make($password);
        $User->save();

        return back()->with('respuesta', 'Password actualizada'); //mensaje flask
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $User = User::findOrFail($id);
        $User->delete();

        return view('usuarios_eliminar', ['respuesta' => "Usuario eliminado "]);
    }
}
