@extends('plantilla')


@section('contenido')

    <!-- nuevo usuario -->
    <div class="btn_nuevo">
        <a href="{{ url('/usuarios') }}" class="w3-button w3-blue"> Atras</a>
    </div>

    <hr>

    <div class="w3-modal-content">
        @if (session('respuesta'))
            <div class="w3-panel w3-pale-green w3-border">
                <p>{{ session('respuesta') }}</p>
            </div>
        @else
            <header class="w3-container w3-light-grey">
                <h2>Editar usuario</h2>
            </header>
            <div class="w3-container">
                <form action="{{ url('/usuarios/' . $usuario->id) }}" method="POST">
                    @csrf 
                    @method('PUT') 

                    <p>
                        <input name="name" class="w3-input w3-border"
                            value="{{ old('name', $usuario->name) }}" maxlength="50" type="text"
                            placeholder="Nombre">
                    </p>
                    {!! $errors->first('name', '<small class="w3-text-red">:message</small>') !!}
                    
                    <p>
                        <input name="email" class="w3-input w3-border" type="text"
                            value="{{ old('email', $usuario->email) }}" maxlength="50" placeholder="Email">
                    </p>
                    {!! $errors->first('email', '<small class="w3-text-red">:message</small>') !!}

                    <p>
                        <select class="w3-select w3-border" id="rol" name="rol">
                            <option @if ($usuario->rol == '')  selected @endif value="" disabled >Rol</option>
                            <option @if ($usuario->rol == 'Administrador')  selected @endif value="Administrador">Administrador</option>
                            <option @if ($usuario->rol == 'Usuario')  selected @endif value="Usuario">Usuario</option>
                        </select>
                    </p>
                    {!! $errors->first('rol', '<small class="w3-text-red">:message</small>') !!}

                    <p>
                        <select class="w3-select w3-border" id="estado" name="estado">
                            <option @if ($usuario->estado == '')  selected @endif value="" disabled >estado</option>
                            <option @if ($usuario->estado == 'Activo')  selected @endif value="Activo">Activo</option>
                            <option @if ($usuario->estado == 'Inactivo')  selected @endif value="Inactivo">Inactivo</option>
                        </select>
                    </p>
                    {!! $errors->first('estado', '<small class="w3-text-red">:message</small>') !!}

                    <p>
                        <button class="w3-button w3-blue w3-padding-large" type="submit">Guardar</button>
                    </p>
                </form>
            </div>
        @endif
    </div>

@endsection
