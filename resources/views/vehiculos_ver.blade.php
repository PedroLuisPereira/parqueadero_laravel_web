@extends('plantilla')


@section('contenido')


    <!-- nuevo cliente -->
    <div class="btn_nuevo">
        <a href="{{ route('vehiculo.index') }}" class="w3-button w3-blue">
            Atras</a>
    </div>

    <hr>

    <div class="w3-container">
        <form class="w3-container w3-card-4 w3-light-grey">
            <h2>Detalles del vehículo</h2>
            <p>
                <label>Placa</label>
                <input class="w3-input w3-border" value="{{ $placa }}"  type="text" />
            </p>

            <p>
                <label>Tipo</label>
                <input class="w3-input w3-border" value="{{ $tipo }}" type="text" />
            </p>
        </form>
    </div>

@endsection
