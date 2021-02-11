@extends('plantilla')


@section('contenido')


    <div class="btn_nuevo">
        <a href="{{ url('/vehiculos') }}" class="w3-button w3-blue">Atras</a>
    </div>

    <hr>

    <div class="w3-modal-content">

        {{-- respuesta del formulario --}}
        @if (session('respuesta'))
            <div class="w3-panel w3-pale-green w3-border">
                <p>{{ session('respuesta') }}</p>
            </div>
        @else

            <header class="w3-container w3-light-grey">
                <h2>Editar Vehiculo</h2>
            </header>
            <div class="w3-container">

                <form action="{{ url('/vehiculos/' . $vehiculo->id) }}" method="POST">
                    @csrf @method('PUT')

                    <p>
                        <input name="placa" class="w3-input w3-border" value="{{ $vehiculo->placa }}" maxlength="50"
                            type="text" placeholder="Placa">
                    </p>
                    {!! $errors->first('placa', '<small class="w3-text-red">:message</small>') !!}

                    <p>
                        <select class="w3-select w3-border" name="tipo">
                            <option @if ($vehiculo->tipo == 'Automovil') selected @endif value="Automovil">Automóvil</option>
                            <option @if ($vehiculo->tipo == 'Moto') selected @endif value="Moto">Moto</option>
                            <option @if ($vehiculo->tipo == 'Bicicleta') selected @endif value="Bicicleta">Bicicleta</option>
                        </select>
                    </p>
                    {!! $errors->first('tipo', '<small class="w3-text-red">:message</small>') !!}

                    <p>
                        <select class="w3-select w3-border" name="cliente_id">
                            @foreach ($clientes as $cliente)
                                <option @if ($cliente->id == $vehiculo->cliente_id) selected @endif value="{{ $cliente->id }}">
                                    {{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </p>
                    {!! $errors->first('cliente_id', '<small class="w3-text-red">:message</small>') !!}



                    <p>
                        <button class="w3-button w3-blue w3-padding-large" type="submit">Guardar</button>
                    </p>
                </form>


            </div>
        @endif
    </div>

@endsection
