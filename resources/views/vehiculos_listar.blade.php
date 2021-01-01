@extends('plantilla')


@section('contenido')

    <!-- nuevo cliente -->
    <div class="w3-row">
        <div class="w3-col m4 l3">
            <div class="btn_nuevo">
                <p></p>
            </div>
        </div>

        <!-- formulario buscar -->
        <form>
            <div class="w3-col m7 l8">
                <div>
                    <input class="w3-input w3-border" type="search" name="buscar" value="<?php echo $buscar; ?>"/>
                </div>
            </div>
            <div class="w3-col m1 l1">
                <div>
                    <button type="submit" class="w3-button w3-border w3-blue"> Buscar </button>
                </div>
            </div>
        </form>
    </div>


    <hr>

    <!-- listado de clientes -->

    <h2>Vehículos Registrados</h2>
    <div class="w3-responsive w3-margin-bottom">
        <table class="w3-table-all">
            <tr class="w3-dark-grey">
                <th>Placa - Serial</th>
                <th>Tipo</th>
                <th>Cliente</th>
                <th>Ver</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>

            @foreach ($vehiculos as $vehiculo)

            <tr>
                <td>{{ $vehiculo->placa }}</td>
                <td>{{ $vehiculo->tipo }}</td>
                <td>{{ $vehiculo->nombre .' '. $vehiculo->apellidos }}</td>
                <td>
                   <a  href="{{ route('vehiculo.show',[ 'vehiculo'=> $vehiculo->id]) }}" class="w3-button w3-highway-green"> Ver</a>
                </td>
                <td>
                    <a href="{{ route('vehiculo.edit',[ 'id'=> $vehiculo->id]) }}"  class="w3-button w3-highway-blue">Editar</a>
                </td>
                <td>
                    <form action="{{ url('/vehiculos/' . $vehiculo->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w3-button w3-highway-red">Eliminar</button>
                    </form>
                </td>
            </tr>

            @endforeach


        </table>
    </div>

    <div class="w3-bar">
        <a href="#" class="w3-button">&laquo;</a>
        <a href="#" class="w3-button w3-blue">1</a>
        <a href="#" class="w3-button">2</a>
        <a href="#" class="w3-button">3</a>
        <a href="#" class="w3-button">4</a>
        <a href="#" class="w3-button">&raquo;</a>
    </div>

@endsection
