<!DOCTYPE html>
<html>

<head>
    <title>Parqueadero</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="public/img/logo.jpg" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-highway.css">
    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Raleway", Arial, Helvetica, sans-serif
        }

    </style>
</head>

<body>
    <div class="w3-bar w3-light-grey w3-large menu">
        <a href="{{ url("/register") }}#" class="w3-bar-item w3-button w3-right w3-mobile {{request()->routeIs('cuenta.*')? 'activo' : '' }}">Registrar</a>
        <a href="{{ url("/login") }}#" class="w3-bar-item w3-button w3-right w3-mobile {{request()->routeIs('cuenta.*')? 'activo' : '' }}">Ingresar</a>
    </div>

    <div>
        <!-- formulario -->
        <div class="registro">
            <div class="w3-card-4">

                <div class="w3-container w3-dark-grey">
                    <h3>Registrar usuario</h3>
                </div>

                <form method="POST" action="{{ route('register') }}" class="w3-container">
                    @csrf

                    <p>
                        <label for="name">Nombre</label>
                        <input id="name" type="text"
                            class="w3-input w3-padding-16 w3-border @error('name') w3-border-red @enderror" name="name"
                            value="{{ old('name') }}" placeholder="Nombre" autofocus/>
                    </p>
                    @error('name')
                        <div class="w3-text-red">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <p>
                        <label for="email">Email</label>
                        <input id="email" type="email"
                            class="w3-input w3-padding-16 w3-border @error('email') w3-border-red @enderror"
                            name="email" value="{{ old('email') }}" placeholder="Email" />
                    </p>
                    @error('email')
                        <div class="w3-panel w3-red w3-display-container">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <p>
                        <label for="password">Password</label>
                        <input id="password" type="password"
                            class="w3-input w3-padding-16 w3-border @error('password') w3-border-red @enderror"
                            name="password" value="{{ old('password') }}" placeholder="password" />
                    </p>
                    @error('password')
                        <div class="w3-panel w3-red w3-display-container">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <p>
                        <label for="password_confirmation">Confirmar password</label>
                        <input id="password_confirmation" type="password"
                            class="w3-input w3-padding-16 w3-border @error('password_confirmation') w3-border-red @enderror"
                            name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirmar password" />
                    </p>
                    @error('password_confirmation')
                        <div class="w3-panel w3-red w3-display-container">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <p>
                        <button class="w3-button w3-blue w3-padding-large" type="submit">
                            Registrar
                        </button>
                    </p>
                </form>
            </div>
        </div>
    </div>


</body>

</html>