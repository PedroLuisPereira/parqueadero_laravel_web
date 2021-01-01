<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Parqueadero;
use App\Tarifa;
use App\Vehiculo;
use App\Cliente;
use App\Servicio;

class ParqueaderoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $automoviles =  Parqueadero::where('tipo', 'Automovil')->get();
        $bicicletas =  Parqueadero::where('tipo', 'Bicicleta')->get();
        $motos =  Parqueadero::where('tipo', 'Moto')->get();

        $data['automoviles'] = $this->cliente($automoviles->toArray());
        $data['bicicletas'] = $this->cliente($bicicletas->toArray());
        $data['motos'] = $this->cliente($motos->toArray());

        return view('parqueaderos_listar', $data);
    }


    public function consultar($placa = '')
    {
        //ver si existe la placa
        $vehiculo = DB::table('vehiculos')->where('placa', $placa)->first();
        if (isset($vehiculo) == false) {
            $this->respuesta("success", null, 'Vehiculo no registrado');
        } else {
            //verificar que el vehiculo no este en servicio
            $registro = Parqueadero::where('vehiculo_id', $vehiculo->id)->first();
            if (isset($registro) == true) {
                $this->respuesta("success", null, 'Vehiculo en servicio');
            } else {
                //buscar tipo de vehiculo
                $tipo = $vehiculo->tipo;
                //verificar que existen parqueaderos disponibles para ese tipo
                $parqueaderos = Parqueadero::where('estado', 'Disponible')->where('tipo', $tipo)->get(); //$parqueadero_modelo->select_disponible_tipo($tipo);
                if (isset($parqueaderos) == false) {
                    $this->respuesta("success", null, 'No existen parqueaderos disponibles');
                } else {
                    $this->respuesta("success", null, null, null, $parqueaderos);
                }
            }
        }
    }



    //agregar informacion del cliente al json
    private function cliente($array_vehiculo)
    {
        for ($i = 0; $i < count($array_vehiculo); $i++) {
            //verificar si el parqueadero esta ocupado
            if ($array_vehiculo[$i]['estado'] == "No disponible") {
                //buscar id del vehiculo parqueado
                $vehiculo_id = $array_vehiculo[$i]['vehiculo_id'];
                //buscar informacion del dueño del vehiculo
                $registro = DB::table('vehiculos')
                    ->join('clientes', 'clientes.id', '=', 'vehiculos.cliente_id')
                    ->select('clientes.*', 'vehiculos.placa')
                    ->where('vehiculos.id', $vehiculo_id)
                    ->first();
                //colocar placa
                $array_vehiculo[$i]['placa'] = $registro->placa;
                //llenar datos del cliente
                $array_vehiculo[$i]['cliente']['nombre'] = $registro->nombre;
                $array_vehiculo[$i]['cliente']['apellidos'] = $registro->apellidos;
                $array_vehiculo[$i]['cliente']['numero_documento'] = $registro->numero_documento;
            }
        }
        //retornar array completo
        return $array_vehiculo;
    }


    private function respuesta($status, $token, $mensaje, $validaciones = array(), $datos = array())
    {
        header("Content-Type: application/json");
        $respuesta = array(
            "status" => $status,
            "token" => $token,
            "mensaje" => $mensaje,
            "validaciones" => $validaciones,
            "datos" => $datos
        );
        echo json_encode($respuesta);
        exit();
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
            'placa' => 'required',
            'parqueadero' => 'required',
        ]);

        $placa = $request->input('placa');
        $parqueadero = $request->input('parqueadero');
        $mensaje = '';

        //validar que existe la placa
        $vehiculo = Vehiculo::where('placa', $placa)->get();
        if (isset($vehiculo) == true) {
            //validar que el vehiculo no esta en servio 
            $vehiculo_id = $vehiculo[0]['id'];
            $registro = Parqueadero::where('vehiculo_id', $vehiculo_id)->get();
            if (isset($registro) == true) {
                $obj_parqueadero = Parqueadero::where('parqueadero', $parqueadero)->get();
                if ($obj_parqueadero[0]['estado'] == 'Disponible') {
                    //hora de entrada
                    $hora_entrada = date("Y-m-d H:i:s");
                    //buscar tipo de vehiculo
                    $tipo = $vehiculo[0]['tipo'];
                    //buscar valor minuto
                    $tarifas = Tarifa::where('id', 1)->get();
                    if ($tipo == 'Automovil') {
                        $valor_minuto = $tarifas[0]['minuto_autos'];
                    } else if ($tipo == 'Moto') {
                        $valor_minuto = $tarifas[0]['minuto_motos'];
                    } else {
                        $valor_minuto = $tarifas[0]['minuto_bicicletas'];
                    }

                    //ingresar servicio
                    $servicio = new Servicio();
                    $servicio->hora_entrada = $hora_entrada;
                    $servicio->valor_minuto = $valor_minuto;
                    $servicio->estado = 'Activo';
                    $servicio->vehiculo_id = $vehiculo_id;
                    $servicio->parqueadero = $parqueadero;
                    $servicio->save();

                    //actualizar parqueadero
                    $cliente = Parqueadero::find($obj_parqueadero[0]['id']);
                    $cliente->estado = 'No disponible';
                    $cliente->vehiculo_id = $vehiculo_id;
                    $cliente->save();

                    $mensaje = "Servicio registrado";
                }
            } else {
                $mensaje = "Error, vehiculo ya está en servicio";
            }
        } else {
            $mensaje = "Eror, vehiculo no existe";
        }

        return back()->with('respuesta', $mensaje); //mensaje flask
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mover($id) //route model binding
    {
        $parqueadero = Parqueadero::findOrFail($id);
        $tipo = $parqueadero->tipo;
        $parqueaderos = Parqueadero::where('tipo', $tipo)->get();
        $this->respuesta("success", null, null, null, $parqueaderos);
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
    public function update(Request $request)
    {

        //validaciones
        $validacion = $request->validate([
            'parqueadero_viejo' => "required",
            'parqueadero_nuevo' => 'required',
        ]);

        $parqueadero_viejo = $request->input('parqueadero_viejo');
        $parqueadero_nuevo = $request->input('parqueadero_nuevo');

        $obj_parqueadero_nuevo = Parqueadero::where('parqueadero', $parqueadero_nuevo)->first();
        $obj_parqueadero_viejo = Parqueadero::where('parqueadero', $parqueadero_viejo)->first();


        if ($obj_parqueadero_nuevo->estado == "Disponible") { // nuevo parqeadero disponible
            //actualizar parqueadero viejo
            $parqueadero = Parqueadero::find($obj_parqueadero_viejo->id);
            $parqueadero->estado = 'Disponible';
            $parqueadero->vehiculo_id = null;
            $parqueadero->save();

            //actualizar parqueadero nuevo
            $parqueadero = Parqueadero::find($obj_parqueadero_nuevo->id);
            $parqueadero->estado = 'No disponible';
            $parqueadero->vehiculo_id = $obj_parqueadero_viejo->vehiculo_id;
            $parqueadero->save();


            //actualizar servicio
            $servicio = Servicio::where('estado', 'Activo')->where('vehiculo_id', $obj_parqueadero_viejo->vehiculo_id)->first();
            $servicio = Servicio::find($servicio->id);
            $servicio->parqueadero = $parqueadero_nuevo;
            $servicio->save();
            
        } else { // si el nuevo parqueadero esta ocupado

            //actualizar parqueadero viejo
            $parqueadero = Parqueadero::find($obj_parqueadero_viejo->id);
            $parqueadero->vehiculo_id = $obj_parqueadero_nuevo->vehiculo_id;
            $parqueadero->save();

            //actualizar parqueadero nuevo
            $parqueadero = Parqueadero::find($obj_parqueadero_nuevo->id);
            $parqueadero->vehiculo_id = $obj_parqueadero_viejo->vehiculo_id;
            $parqueadero->save();


            //actualizar servicio viejo
            $servicio = Servicio::where('estado', 'Activo')->where('vehiculo_id', $obj_parqueadero_viejo->vehiculo_id)->first();
            $servicio = Servicio::find($servicio->id);
            $servicio->parqueadero = $parqueadero_nuevo;
            $servicio->save();

            //actualizar servicio nuevo
            $servicio = Servicio::where('estado', 'Activo')->where('vehiculo_id', $obj_parqueadero_nuevo->vehiculo_id)->first();
            $servicio = Servicio::find($servicio->id);
            $servicio->parqueadero = $parqueadero_viejo;
            $servicio->save();
        }
        
        return back()->with('respuesta', 'Parqueadero actualizado'); //mensaje flask
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id del parqueadero
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //buscar parqueadero
        $obj_parqueadero = Parqueadero::findOrFail($id);

        //buscar id del vehiculo
        $vehiculo_id = $obj_parqueadero->vehiculo_id;

        //buscar servicio
        $obj_servicio = Servicio::where('estado', 'Activo')->where('vehiculo_id', $vehiculo_id)->first();

        $mensaje = '';
        if (isset($obj_servicio) == true) {

            //hora_entrada
            $hora_entrada = $obj_servicio->hora_entrada;
            $entrada = strtotime($hora_entrada);

            //hora de salida 
            $hora_salida = date("Y-m-d H:i:s");
            $salida = strtotime($hora_salida);

            //minutos        
            $minutos = round(($salida - $entrada) / 60);

            //buscar vehiculo
            $obj_vehiculo = Vehiculo::find($obj_servicio->vehiculo_id);
            $tipo = $obj_vehiculo->tipo;

            //tarifas
            $tarifas = Tarifa::where('id', 1)->first();
            if ($tipo == 'Automovil') {
                $valor_minuto = $tarifas->minuto_autos;
            } else if ($tipo == 'Moto') {
                $valor_minuto = $tarifas->minuto_motos;
            } else {
                $valor_minuto = $tarifas->minuto_bicicletas;
            }

            //descuento
            $minutos_descuento = $tarifas->minutos;
            if ($minutos >= $minutos_descuento) {
                $descuento = $tarifas->descuento;
                $valor_minuto = $valor_minuto * (1 - $descuento / 100);
            }

            //valor total
            $total = $minutos * $valor_minuto;

            //actualizar servico 
            $obj_servicio = Servicio::findOrFail($obj_servicio->id);
            $obj_servicio->hora_salida = $hora_salida;
            $obj_servicio->minutos = $minutos;
            $obj_servicio->total = $total;
            $obj_servicio->valor_minuto = $valor_minuto;
            $obj_servicio->estado = 'Terminado';
            $obj_servicio->save();

            //actualizar parqueadero
            $obj_parqueadero->estado = "Disponible";
            $obj_parqueadero->vehiculo_id = null;
            $obj_parqueadero->save();

            $mensaje = "Servicio terminado";
        } else {
            $mensaje = "Error - no existe servicio";
        }

        return back()->with('respuesta', $mensaje); //mensaje flask
    }
}
