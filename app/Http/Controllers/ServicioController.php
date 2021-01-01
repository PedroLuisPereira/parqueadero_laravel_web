<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cliente;
use App\Parqueadero;
use App\Servicio;
use App\Tarifa;
use App\Vehiculo;

class ServicioController extends Controller
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

            $servicios = DB::table('servicios')
                ->join('vehiculos', 'vehiculos.id', '=', 'servicios.vehiculo_id')
                ->select('servicios.*', 'vehiculos.*')
                ->where('placa', 'like', "%$buscar%")
                ->orWhere('parqueadero', 'like', "%$buscar%")
                ->orWhere('estado', 'like', "%$buscar%")
                ->get();
        } else {
            $servicios = DB::table('servicios')
                ->join('vehiculos', 'vehiculos.id', '=', 'servicios.vehiculo_id')
                ->select('servicios.*', 'vehiculos.*')
                ->get();
        }

        $data = array(
            'servicios' => $servicios,
            'buscar' => $buscar
        );

        return view('servicios_listar', $data);
        //return $servicios;
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
