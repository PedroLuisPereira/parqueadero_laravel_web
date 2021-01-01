<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Tarifa;


class TarifasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tarifas = Tarifa::findOrFail(1);
        $data = array(
            'tarifas' => $tarifas,
        );
        return view('tarifas_listar', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
            'minuto_autos' => "required",
            'minuto_bicicletas' => 'required',
            'minuto_motos' => 'required',
            'descuento' => 'required',
            'minutos' => 'required',
        ]);

        //capturar datos 
        $minuto_autos = $request->input('minuto_autos');
        $minuto_bicicletas = $request->input('minuto_bicicletas');
        $minuto_motos = $request->input('minuto_motos');
        $descuento = $request->input('descuento');
        $minutos = $request->input('minutos');

        //guardar
        $tarifa = Tarifa::findOrFail(1);
        $tarifa->minuto_autos = $minuto_autos;
        $tarifa->minuto_bicicletas = $minuto_bicicletas;
        $tarifa->minuto_motos = $minuto_motos;
        $tarifa->descuento = $descuento;
        $tarifa->minutos = $minutos;
        $tarifa->save();

        return back()->with('respuesta', 'Tarifas actualizadas'); //mensaje flask
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //route model binding
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        
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

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
