@extends('plantilla')


@section('contenido')


    <!-- boton atras -->
    <div class="btn_nuevo">
        <a href="{{ route('cliente.index') }}" class="w3-button w3-blue"> Atras</a>
    </div>

    <hr>

    {{-- formulario nuevo --}}
    <div class="w3-modal-content">

        {{-- respuesta del formulario --}}
        @if (session('respuesta'))
            <div class="w3-panel w3-pale-green w3-border">
                <p>{{ session('respuesta') }}</p>
            </div>
        @else

            <header class="w3-container w3-light-grey">
                <h2>Nuevo Vehiculo</h2>
            </header>
            <div class="w3-container">


                <form action="{{ route('vehiculo.store') }}" method="POST">
                    @csrf
                    <p>
                        <input name="placa" class="w3-input w3-border" value="{{ old('placa') }}" type="text"
                            maxlength="50" placeholder="Placa - Serial">
                    </p>
                    {!! $errors->first('placa', '<small class="w3-text-red">:message</small>') !!}

                    <p>
                        <select class="w3-select w3-border" name="tipo">
                            <option @if (old('tipo') == '') selected @endif
                                disable value="">Tipo</option>
                            <option @if (old('tipo') == 'Automovil') selected @endif value="Automovil">Automóvil</option>
                            <option @if (old('tipo') == 'Moto') selected @endif value="Moto">Moto</option>
                            <option @if (old('tipo') == 'Bicicleta') selected @endif value="Bicicleta">Bicicleta</option>
                        </select>
                    </p>
                    {!! $errors->first('tipo', '<small class="w3-text-red">:message</small>') !!}

                    <input type="hidden" name="cliente_id" value="{{ $cliente_id }}">

                    <p>
                        <button class="w3-button w3-blue w3-padding-large" type="submit">Guardar</button>
                    </p>
                </form>


            </div>

        @endif
    </div>

@endsection
