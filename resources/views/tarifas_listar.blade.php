@extends('plantilla')


@section('contenido')

    @if (session('respuesta'))
        <div class="w3-panel w3-pale-green w3-border">
            <p>{{ session('respuesta') }}</p>
        </div>
    @endif

    <div class="formulario">
        <div class="w3-card-4">
            <div class="w3-container w3-dark-grey">
                <h2>Tarifas</h2>
            </div>

            <form action="{{ route('tarifa.store') }}" method="POST" class="w3-container">
                @csrf
                <p>
                    <label for="">Valor Minuto Automoviles</label>
                    <input name="minuto_autos"
                        value="{{ $tarifas->minuto_autos }}"
                        class="w3-input w3-border" type="number" min="0" step="0.01" placeholder="Valor Minuto Automoviles "
                        required>
                </p>
                <p>
                    <label for="">Valor Minutos Motos</label>
                    <input name="minuto_motos"
                        value="{{ $tarifas->minuto_bicicletas }}"
                        class="w3-input w3-border" type="number" min="0" step="0.01" placeholder="Valor Minutos Motos"
                        required>
                </p>
                <p>
                    <label for="">Valor Minutos Bicicletas</label>
                    <input name="minuto_bicicletas"
                        value="{{ $tarifas->minuto_motos }}"
                        class="w3-input w3-border" type="number" min="0" step="0.01" placeholder="Valor Minutos Bicicletas"
                        required>
                </p>
                <h4>Descuentos</h4>
                <p>
                    <label for="">Minuto para obtener el descuento</label>
                    <input name="minutos" value="{{ $tarifas->descuento }}"
                        class="w3-input w3-border" type="number" placeholder="Placa-Serial" min="0" required>
                </p>
                <p>
                    <label for="">Descuento %</label>
                    <input name="descuento" value="{{ $tarifas->minutos }}"
                        class="w3-input w3-border" type="number" placeholder="Placa-Serial" min="0" step="0.01" required>
                </p>


                <p>
                    <button class="w3-button w3-blue w3-padding-large" type="submit">Guardar</button>
                </p>


            </form>
        </div>

    </div>






@endsection
