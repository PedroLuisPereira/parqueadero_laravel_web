<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;


class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rol');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buscar = '';

        if (isset($_GET['buscar'])) {
            $buscar = $_GET['buscar'];

            $usuarios = DB::table('users')
                ->where('name', 'like', "%$buscar%")
                ->orWhere('email', 'like', "%$buscar%")
                ->orWhere('rol', 'like', "%$buscar%")
                ->orWhere('estado', 'like', "%$buscar%")
                ->get();
        } else {
            $usuarios = User::all();
        }

        $data = array(
            'usuarios' => $usuarios,
            'buscar' => $buscar
        );

        return view('usuarios_listar', $data);
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
    public function edit($id)
    {
        $usuarios = User::findOrFail($id);
        $data = array(
            'usuario' => $usuarios
        );

        return view('usuarios_editar', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //validaciones
        $validacion = $request->validate([
            'name' => 'required|max:255',
            'email' => "required|max:255|email|unique:users,email,$id",
            'rol' => 'required|max:255',
            'estado' => 'required|max:255',
        ]);

        //capturar datos 
        $name = $request->input('name');
        $email = $request->input('email');
        $rol = $request->input('rol');
        $estado = $request->input('estado');

        //guardar
        $User = User::findOrFail($id);
        $User->name = $name;
        $User->email = $email;
        $User->rol = $rol;
        $User->estado= $estado;
        $User->save();

        return back()->with('respuesta', 'Usuario actualizado'); //mensaje flask
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
