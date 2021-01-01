<!DOCTYPE html>
<html>

<head>
    <title>Parqueadero</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/logo.jpg') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}" >
 
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

    <!-- Navigation Bar -->
    <div class="w3-bar w3-light-grey w3-large menu">
        <a href="{{ url("/parqueaderos") }}" class="w3-bar-item w3-button w3-dark-grey w3-mobile">Parqueadero</a>
        <a href="{{ url("/clientes") }}" class="w3-bar-item w3-button w3-mobile {{request()->routeIs('cliente.*')? 'activo' : '' }} ">Clientes</a>
        <a href="{{ url("/vehiculos") }}" class="w3-bar-item w3-button w3-mobile {{request()->routeIs('vehiculo.*')? 'activo' : '' }}">Vehículos</a>
        <a href="{{ url("servicios") }}" class="w3-bar-item w3-button w3-mobile {{request()->routeIs('servicio.*')? 'activo' : '' }}">Servicios</a>
        <a href="{{ url("/tarifas") }}" class="w3-bar-item w3-button w3-mobile {{request()->routeIs('tarifa.*')? 'activo' : '' }}">Tarifas</a>
        <a href="{{ url("/usuarios") }}usuarios" class="w3-bar-item w3-button w3-mobile {{request()->routeIs('usuario.*')? 'activo' : '' }}">Usuarios</a>
        <a href="{{ url("/cuenta") }}#" class="w3-bar-item w3-button w3-right w3-mobile {{request()->routeIs('cuenta.*')? 'activo' : '' }}">Cuenta</a>
    </div>

    <div class="contenido">
        @yield('contenido')
    </div>
       
</body>

</html>

