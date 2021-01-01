@extends('plantilla')


@section('contenido')

    <!-- nuevo cliente -->
    <div class="w3-row">
        <div class="w3-col m4 l3">
            <div class="btn_nuevo">
                <a href="clientes_crear.php" class="w3-button w3-green">Exportar a Excel</a>
            </div>
        </div>

        <!-- formulario buscar -->
        <form>
            <div class="w3-col m7 l8">
                <div>
                    <input class="w3-input w3-border" type="search" name="buscar" value="{{ $buscar }}" />
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
    <h2>Servicios</h2>
    <div class="w3-responsive w3-margin-bottom">
        <table class="w3-table-all">
            <tr class="w3-dark-grey">
                <th>Placa</th>
                <th>Parqueadero</th>
                <th>Estado</th>
                <th>Hora entrada</th>
                <th>Hora salida</th>
                <th>Minutos</th>
                <th>Valor minuto</th>
                <th>Total </th>
            </tr>
            @foreach ($servicios as $servicio)
                <tr>
                    <td>{{ $servicio->placa }}</td>
                    <td>{{ $servicio->parqueadero }}</td>
                    <td>{{ $servicio->estado }}</td>
                    <td>{{ $servicio->hora_entrada }}</td>
                    <td>{{ $servicio->hora_salida }}</td>
                    <td>{{ $servicio->minutos }}</td>
                    <td>{{ $servicio->valor_minuto }}</td>
                    <td>{{ $servicio->total }}</td>
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
