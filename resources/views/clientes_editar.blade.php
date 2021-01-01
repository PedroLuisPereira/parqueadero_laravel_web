@extends('plantilla')


@section('contenido')

    <!-- nuevo cliente -->
    <div class="btn_nuevo">
        <a href="{{ url('/clientes') }}" class="w3-button w3-blue"> Atras</a>
    </div>

    <hr>

    <div class="w3-modal-content">
        @if (session('respuesta'))
            <div class="w3-panel w3-pale-green w3-border">
                <p>{{ session('respuesta') }}</p>
            </div>
        @else
            <header class="w3-container w3-light-grey">
                <h2>Editar Cliente</h2>
            </header>
            <div class="w3-container">
                <form action="{{ url('/clientes/' . $cliente->id) }}" method="POST">
                    @csrf {{-- <input type="hidden" name="_token"
                        value="eIuvPejGZUSZocAwvSNZ8Xe4UroySS3FdWewi54C"> --}}
                    @method('PUT') {{-- <input type="hidden" name="_method" value="PUT">
                    --}}
                    <p>
                        <input name="numero_documento" class="w3-input w3-border"
                            value="{{ old('numero_documento', $cliente->numero_documento) }}" maxlength="50" type="text"
                            placeholder="Número Documento ">
                    </p>
                    {!! $errors->first('numero_documento', '<small class="w3-text-red">:message</small>') !!}
                    <p>
                        <input name="nombre" class="w3-input w3-border" type="text"
                            value="{{ old('nombre', $cliente->nombre) }}" maxlength="50" placeholder="Nombre">
                    </p>
                    {!! $errors->first('nombre', '<small class="w3-text-red">:message</small>') !!}
                    <p>
                        <input name="apellidos" class="w3-input w3-border" type="text"
                            value="{{ old('apellidos', $cliente->apellidos) }}" maxlength="50" placeholder="Apellidos">
                    </p>
                    {!! $errors->first('apellidos', '<small class="w3-text-red">:message</small>') !!}
                    <p>
                        <button class="w3-button w3-blue w3-padding-large" type="submit">Guardar</button>
                    </p>
                </form>
            </div>
        @endif
    </div>

@endsection
