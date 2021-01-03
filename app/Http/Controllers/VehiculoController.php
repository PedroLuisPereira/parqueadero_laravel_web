<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cliente;
use App\Vehiculo;
use App\Servicio;

class VehiculoController extends Controller
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
        $buscar = '';

        if (isset($_GET['buscar'])) {
            $buscar = $_GET['buscar'];

            $vehiculos = DB::table('vehiculos')
            ->join('clientes', 'clientes.id', '=', 'vehiculos.cliente_id')
            ->select('vehiculos.*', 'clientes.nombre', 'clientes.apellidos')
            ->where('placa', 'like', "%$buscar%")
            ->orWhere('tipo', 'like', "%$buscar%")
            ->get();
        } else {
            $vehiculos = DB::table('vehiculos')
            ->join('clientes', 'clientes.id', '=', 'vehiculos.cliente_id')
            ->select('vehiculos.*', 'clientes.nombre', 'clientes.apellidos')
            ->get();
        }

        $data = array(
            'vehiculos' => $vehiculos,
            'buscar' => $buscar
        );

        return view('vehiculos_listar', $data);

    }

    public function listar_cliente_id($cliente_id)
    {
        $vehiculos = Vehiculo::where('cliente_id',$cliente_id)->get();
        $data = array(
            'vehiculos' => $vehiculos
        );
        return view('vehiculos_clientes', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data = array(
            'cliente_id' => $id
        );
        
        return view('vehiculos_crear',$data);
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
            'placa' => 'required|max:50|unique:vehiculos,placa',
            'tipo' => 'required|max:50',
            'cliente_id' => 'required|max:50',
        ]);


        //capturar datos 
        $placa = $request->input('placa');
        $tipo = $request->input('tipo');
        $cliente_id = $request->input('cliente_id');

        $vehiculo = new Vehiculo();
        $vehiculo->placa = strtoupper($placa);
        $vehiculo->tipo = $tipo;
        $vehiculo->cliente_id = $cliente_id;
        $vehiculo->save();

        return back()->with('respuesta', 'Vehiculo creado'); //mensaje flask
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Vehiculo $vehiculo) //route model binding
    {
        //return $vehiculo;
        $data = array(
            'placa' => $vehiculo->placa,
            'tipo' => $vehiculo->tipo,
        );

        return view('vehiculos_ver', $data);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $data = array(
            'vehiculo' => $vehiculo
        );

        return view('vehiculos_editar', $data);
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
            'placa' => "required|max:50|unique:vehiculos,placa,$id",
            'tipo' => 'required|max:50',
        ]);
        
        //capturar datos 
        $placa = $request->input('placa');
        $tipo = $request->input('tipo');
        
        //guardar
        $vehiculo = Vehiculo::findOrFail($id);
        $vehiculo->placa = strtoupper($placa);
        $vehiculo->tipo = $tipo;
        $vehiculo->save();
        
        //llamar a la vista
        return back()->with('respuesta', 'Vehiculo actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $servicios = Servicio::where('vehiculo_id', $id)->get();

        if (count($servicios)>0) {
            return view('vehiculos_eliminar', ['respuesta' => "No se puede eliminar el vehiculo"]);
        }
        
        $vehiculo = Vehiculo::findOrFail($id);
        $vehiculo->delete();
        
        return view('vehiculos_eliminar', ['respuesta' => "Vehiculo eliminado "]);
    }
}
