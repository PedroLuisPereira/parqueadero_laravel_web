@extends('plantilla')


@section('contenido')

    <!-- nuevo cliente -->
    <div class="btn_nuevo">
        <a href="{{ url('/vehiculos') }}" class="w3-button w3-blue"> Atras</a>
    </div>

    <hr>

    <div class="w3-modal-content">
        {{-- respuesta --}}
        <div class="w3-panel w3-pale-green w3-border">
            <p>{{ $respuesta }}</p>
        </div>
    </div>
@endsection
