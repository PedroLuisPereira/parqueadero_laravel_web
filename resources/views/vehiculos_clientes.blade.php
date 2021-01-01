@extends('plantilla')


@section('contenido')

<div class="btn_nuevo">
    <a href="{{ url('/clientes') }}" class="w3-button w3-blue"> Atras</a>
</div>

<hr>


<div class="w3-modal-content">
    <header class="w3-container w3-light-grey">
        <h2>Vehículos del Cliente</h2>
    </header>
    <br>
    <div class="w3-container">
        <div class="w3-responsive">
            <table class="w3-table-all">
                <tr class="w3-dark-grey">
                    <th>Placa</th>
                    <th>Tipo</th>
                </tr>
                @foreach ($vehiculos as $item)

                    <tr>
                        <td>{{ $item->placa }}</td>
                        <td>{{ $item->tipo }}</td>
                    </tr>

                @endforeach
            </table>
        </div>
    </div>
    <br />
    <br />
</div>

@endsection
