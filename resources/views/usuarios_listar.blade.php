@extends('plantilla')


@section('contenido')


     <!-- nuevo usuario -->
    <div class="w3-row">
        <div class="w3-col m4 l3">
            <div class="btn_nuevo">
                <a href="{{ url('/usuarios/crear') }}" class="w3-button w3-blue">+ Nuevo usuario</a>
            </div>
        </div>

        <!-- formulario buscar -->
        <form>
            <div class="w3-col m7 l8">
                <div>
                    <input class="w3-input w3-border" value="{{ $buscar }}" type="search" name="buscar"/>
                </div>
            </div>
            <div class="w3-col m1 l1">
                <div>
                    <button type="submit" class="w3-button w3-border w3-blue"> Buscar </button>
                </div>
            </div>
        </form>
    </div>


    <hr>

    <!-- listado de usuarios -->

    <h2>Usuarios Registrados</h2>
    <div class="w3-responsive w3-margin-bottom">
        <table class="w3-table-all">
            <tr class="w3-dark-grey">
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
            @foreach ($usuarios as $usuario)

                <tr>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->rol }}</td>
                    <td>{{ $usuario->estado }}</td>
                    <td>
                        <a href="{{ url('/usuarios/' . $usuario->id . '/edit/') }}"
                            class="w3-button w3-highway-blue">Editar</a>
                    </td>
                    <td>
                        <form action="{{ url('/usuarios/' . $usuario->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w3-button w3-highway-red">Eliminar</button>
                        </form>
                    </td>
                </tr>

            @endforeach

        </table>
    </div>

    <div class="w3-bar">
        <a href="#" class="w3-button">&laquo;</a>
        <a href="#" class="w3-button w3-blue">1</a>
        <a href="#" class="w3-button">2</a>
        <a href="#" class="w3-button">3</a>
        <a href="#" class="w3-button">4</a>
        <a href="#" class="w3-button">&raquo;</a>
    </div>

@endsection
