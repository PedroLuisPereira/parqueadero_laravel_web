@extends('plantilla')


@section('contenido')


    <!-- nuevo cliente -->
    <div class="w3-row">
        <div class="w3-col m4 l3">
            <div class="btn_nuevo">
                <a href="{{ url('/clientes/crear') }}" class="w3-button w3-blue">+ Nuevo Cliente</a>
            </div>
        </div>

        <!-- formulario buscar -->
        <form>
            <div class="w3-col m7 l8">
                <div>
                    <input class="w3-input w3-border" value="{{ $buscar }}" type="search" name="buscar" />
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

    <h2>Clientes Registrados</h2>
    <div class="w3-responsive w3-margin-bottom">
        <table class="w3-table-all">
            <tr class="w3-dark-grey">
                <th>Número documento</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Editar</th>
                <th>Agregar Vehículo</th>
                <th>Vehículos</th>
                <th>Eliminar</th>
            </tr>
            @foreach ($clientes as $cliente)

                <tr>
                    <td>{{ $cliente->numero_documento }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->apellidos }}</td>
                    <td>
                        <a href="{{ url('/clientes/' . $cliente->id . '/edit/') }}"
                            class="w3-button w3-highway-blue">Editar</a>
                    </td>
                    <td>
                        <a href="{{ url('/vehiculos/crear/' . $cliente->id) }}"
                            class="w3-button w3-highway-orange">Agregar</a>
                    </td>
                    <td>
                        <a href="{{ url('/vehiculos/listar/' . $cliente->id) }}" class="w3-button w3-highway-green">
                            Ver</a>
                    </td>
                    <td>
                        <form action="{{ url('/clientes/' . $cliente->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w3-button w3-highway-red">Eliminar</button>
                        </form>
                    </td>
                </tr>

            @endforeach

        </table>
    </div>

    <div class="w3-right">
        <div class="w3-bar">
            <a href="#" class="w3-button">&laquo;</a>
            <a href="#" class="w3-button w3-blue">1</a>
            <a href="#" class="w3-button">2</a>
            <a href="#" class="w3-button">3</a>
            <a href="#" class="w3-button">4</a>
            <a href="#" class="w3-button">&raquo;</a>
        </div>
    </div>
 
@endsection

