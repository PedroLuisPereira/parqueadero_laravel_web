@extends('plantilla')


@section('contenido')

    <!-- nuevo cliente -->
    <div class="btn_nuevo">
        <a href="{{ url('/usuarios') }}" class="w3-button w3-blue"> Atras</a>
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
                <h2>Nuevo Usuario</h2>
            </header>
            <div class="w3-container">
                {{-- formulario --}}
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <p>
                        <input name="name" class="w3-input w3-border" value="{{ old('name') }}"
                            maxlength="50" type="text" placeholder="Nombre">
                    </p>
                    {!! $errors->first('name', '<small class="w3-text-red">:message</small>') !!}
                    <p>
                        <input name="email" class="w3-input w3-border" value="{{ old('email') }}" type="email"
                            maxlength="50" placeholder="Email">
                    </p>
                    {!! $errors->first('email', '<small class="w3-text-red">:message</small>') !!}
                    <p>
                        <input name="password" class="w3-input w3-border" value="{{ old('password') }}" type="password"
                            maxlength="50" placeholder="password">
                    </p>
                    {!! $errors->first('password', '<small class="w3-text-red">:message</small>') !!}
                    
                    <p>
                        <select class="w3-select w3-border" name="rol">
                            <option value="" disabled selected>Rol</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Usuario">Usuario</option>
                        </select>
                    </p>
                    {!! $errors->first('rol', '<small class="w3-text-red">:message</small>') !!}
                    <hr>

                    <p>
                        <button class="w3-button w3-blue w3-padding-large" type="submit">Guardar</button>
                    </p>
                </form>
            </div>
        @endif

    </div>

@endsection
