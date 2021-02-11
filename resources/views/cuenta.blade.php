@extends('plantilla')


@section('contenido')

    <div class="w3-content w3-margin-top" style="max-width: 1400px">
        <!-- The Grid -->
        <div class="w3-row-padding">
            <!-- Left Column -->
            <div class="w3-third">
                <div class="w3-white w3-text-grey w3-card-4">
                    <div class="w3-display-container">
                        @if ($usuario->foto)
                            <img src="/storage/{{ $usuario->foto }}" style="width: 100%" alt="Avatar" />
                        @else
                            <img src="{{ asset('img/avatar.jpg') }}" style="width: 100%" alt="Avatar" />
                        @endif
                        <div class="w3-display-bottomleft w3-container w3-text-black"></div>
                    </div>
                </div>

                <!-- End Left Column -->
            </div>

            <!-- Right Column -->
            <div class="w3-twothird">
                {{-- datos del usuario --}}
                <div class="w3-container w3-card w3-white w3-margin-bottom">
                    <div class="w3-container">
                        <h2>{{ $usuario->name }}</h2>
                        <p>
                            <i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i>
                            {{ $usuario->email }}
                        </p>
                        <p>
                            <i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i>
                            {{ $usuario->rol }}
                        </p>
                        <hr />
                        <p>
                        <div class="">
                            <a class="w3-button w3-red" href="#"
                                onclick="event.preventDefault();  document.getElementById('logout-form').submit();">Cerrar
                                sesión</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                        </p>
                    </div>
                </div>
                {{-- subir imagen --}}
                <div class="w3-container w3-card w3-white w3-margin-bottom">
                    <h3 class="w3-text-grey w3-padding-16">
                        <i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Agregar avatar
                    </h3>
                    @if (session('avatar'))
                        <div class="w3-panel w3-pale-green w3-border">
                            <p>{{ session('avatar') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('cuenta.store_img') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <p>
                            <input class="w3-input w3-border" type="file" name="avatar" id="" />
                        </p>
                        {!! $errors->first('avatar', '<small class="w3-text-red">:message</small>') !!}
                        <p>
                            <button type="submit" class="w3-button w3-border w3-blue">Agregar </button>
                        </p>
                    </form>
                    <hr />
                </div>
                {{-- cambiar contraseña --}}
                <div class="w3-container w3-card w3-white w3-margin-bottom">
                    <h3 class="w3-text-grey w3-padding-16">
                        <i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Actualizar password
                    </h3>

                    <div class="w3-container">
                        <?php if (isset($respuesta)): ?>
                        <div class="w3-panel w3-pale-green w3-border">
                            <p><?php echo $respuesta; ?></p>
                        </div>
                        <?php endif; ?>
                    </div>


                    <form action="{{ url('/cuenta/') }}" method="POST">
                        @csrf
                        @method('PUT')

                        @if (session('respuesta'))
                            <div class="w3-panel w3-pale-green w3-border">
                                <p>{{ session('respuesta') }}</p>
                            </div>
                        @endif

                        <p>
                            <label for="">Nueva password</label>
                            <input name="password" class="w3-input w3-border" type="password" placeholder="Password" />
                        </p>
                        <p>
                            <label for="">Confirmar password</label>
                            <input name="confirmar_password" class="w3-input w3-border" type="password"
                                placeholder="Confirmar password" />
                        </p>

                        <p>
                            <button type="submit" class="w3-button w3-border w3-blue">
                                Guardar
                            </button>
                        </p>
                    </form>
                </div>
                <!-- End Right Column -->
            </div>
        </div>
    </div>

@endsection
