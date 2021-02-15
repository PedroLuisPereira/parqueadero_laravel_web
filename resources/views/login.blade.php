<!DOCTYPE html>
<html>

<head>
    <title>Parqueadero</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="public/img/logo.jpg" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/logo.jpg') }}" />
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
    <div>
        <!-- formulario -->
        <div class="login">
            <div class="w3-card-4">

                <div class="w3-container w3-dark-grey">
                    <h3>Login</h3>
                </div>

                <form action="{{ route('auth.login') }}" method="POST" class="w3-container">

                    @csrf

                    <p>
                        @error('datos')
                        <div class="w3-text-red">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    </p>

                    <p>
                        <label for="email">Email</label>
                        <input id="email" type="email"
                            class="w3-input w3-padding-16 w3-border @error('email') w3-border-red @enderror"
                            name="email" value="{{ old('email') }}" placeholder="Email" />
                    </p>
                    @error('email')
                        <div class="w3-text-red">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <p>
                        <label for="password">Password</label>
                        <input id="password" type="password"
                            class="w3-input w3-padding-16 w3-border @error('password') w3-border-red @enderror"
                            name="password" value="{{ old('password') }}" placeholder="Password" />
                    </p>
                    @error('password')
                        <div class="w3-text-red">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <p>
                        <input class="w3-check" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                        <label>Recordar</label>
                    </p>
                    <p>
                        <button class="w3-button w3-blue w3-padding-large" type="submit">
                            Ingresar
                        </button>
                    </p>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
