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
    <div>
        <!-- formulario -->
        <div class="login">
            <div class="w3-card-4">

                <div class="w3-container w3-dark-grey">
                    <h3>Login</h3>
                </div>

                <form action="{{ route('login') }}" method="POST" class="w3-container">
                    @csrf
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
                        @if (Route::has('password.request'))
                            <a class="" href="{{ route('password.request') }}">Recuperar Password</a>
                        @endif
                    </p>
                </form>
            </div>
        </div>
    </div>

</body>

</html>


{{--


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
