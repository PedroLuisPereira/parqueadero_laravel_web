@extends('plantilla')


@section('contenido')

    <!-- nuevo cliente -->
    <div class="btn_nuevo">
        <a href="{{ url('/clientes') }}" class="w3-button w3-blue"> Atras</a>
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
                <h2>Nuevo Cliente</h2>
            </header>
            <div class="w3-container">
                {{-- formulario --}}
                <form action="{{ route('cliente.store') }}" method="POST">
                    @csrf
                    <p>
                        <input name="numero_documento" class="w3-input w3-border" value="{{ old('numero_documento') }}"
                            maxlength="50" type="text" placeholder="Número Documento">
                    </p>
                    {!! $errors->first('numero_documento', '<small class="w3-text-red">:message</small>') !!}
                    <p>
                        <input name="nombre" class="w3-input w3-border" value="{{ old('nombre') }}" type="text"
                            maxlength="50" placeholder="Nombre">
                    </p>
                    {!! $errors->first('nombre', '<small class="w3-text-red">:message</small>') !!}
                    <p>
                        <input name="apellidos" class="w3-input w3-border" value="{{ old('apellidos') }}" type="text"
                            maxlength="50" placeholder="Apellidos">
                    </p>
                    {!! $errors->first('apellidos', '<small class="w3-text-red">:message</small>') !!}
                    <h4>Datos del vehículo</h4>
                    <p>
                        <input name="placa" class="w3-input w3-border" value="{{ old('placa') }}" type="text" maxlength="50"
                            placeholder="Placa - Serial">
                    </p>
                    {!! $errors->first('placa', '<small class="w3-text-red">:message</small>') !!}

                    <p>
                        <select class="w3-select w3-border" name="tipo">
                            <option value="" disabled selected>Tipo</option>
                            <option value="Automovil">Automóvil</option>
                            <option value="Moto">Moto</option>
                            <option value="Bicicleta">Bicicleta</option>
                        </select>
                    </p>
                    {!! $errors->first('tipo', '<small class="w3-text-red">:message</small>') !!}
                    <hr>

                    <p>
                        <button class="w3-button w3-blue w3-padding-large" type="submit">Guardar</button>
                    </p>
                </form>
            </div>
        @endif

    </div>

@endsection
