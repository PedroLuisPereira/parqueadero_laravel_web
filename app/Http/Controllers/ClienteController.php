<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cliente;
use App\Vehiculo;

class ClienteController extends Controller
{
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

            $clientes = DB::table('clientes')
                ->where('numero_documento', 'like', "%$buscar%")
                ->orWhere('nombre', 'like', "%$buscar%")
                ->orWhere('apellidos', 'like', "%$buscar%")
                ->get();
        } else {
            $clientes = Cliente::all();
        }

        $data = array(
            'clientes' => $clientes,
            'buscar' => $buscar
        );

        return view('clientes_listar', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes_crear');
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
            'numero_documento' => 'required|max:50|unique:clientes,numero_documento',
            'nombre' => 'required|max:50',
            'apellidos' => 'required|max:50',
            'placa' => 'required|max:50|unique:vehiculos,placa',
            'tipo' => 'required|max:50',
        ]);

        //capturar datos 
        $numero_documento = $request->input('numero_documento');
        $nombre = $request->input('nombre');
        $apellidos = $request->input('apellidos');
        $placa = $request->input('placa');
        $tipo = $request->input('tipo');


        //crear cliente o se puede usar asiganacion masiva (cuando se tienen muchos campos)- modelo
        $cliente = new Cliente;
        $cliente->numero_documento = $numero_documento;
        $cliente->nombre = $nombre;
        $cliente->apellidos = $apellidos;
        $cliente->save();

        //crear vehiculo
        $vehiculo = new Vehiculo;
        $vehiculo->placa = $placa;
        $vehiculo->tipo = $tipo;
        $vehiculo->cliente_id = $cliente->id;
        $vehiculo->save();

        return back()->with('respuesta', 'Usuario creado'); //mensaje flask
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente) //route model binding
    {
        return $cliente;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        // $cliente = Cliente::find($id);
        $cliente = Cliente::findOrFail($id);
        $data = array(
            'cliente' => $cliente
        );

        return view('clientes_editar', $data);
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
            'numero_documento' => "required|max:50|unique:clientes,numero_documento,$id",
            'nombre' => 'required|max:50',
            'apellidos' => 'required|max:50',
        ]);

        //capturar datos 
        $numero_documento = $request->input('numero_documento');
        $nombre = $request->input('nombre');
        $apellidos = $request->input('apellidos');

        //guardar
        $cliente = Cliente::findOrFail($id);
        $cliente->numero_documento = $numero_documento;
        $cliente->nombre = $nombre;
        $cliente->apellidos = $apellidos;
        $cliente->save();

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
        $vehiculos = Vehiculo::where('cliente_id', $id)->get();
        if (count($vehiculos) > 0) {
            return view('clientes_eliminar', ['respuesta' => "No se puede eliminar el cliente"]);
        }
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return view('clientes_eliminar', ['respuesta' => "Cliente eliminado "]);
    }
}
