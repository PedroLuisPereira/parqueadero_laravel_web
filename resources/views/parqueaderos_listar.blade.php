@extends('plantilla')


@section('contenido')

    <!-- formulario -->
    <div class="formulario">
        <div class="w3-card-4">
            <div class="w3-container w3-dark-grey">
                <h3>Ingresar Vehículo</h3>
            </div>

            <form action="{{ route('parqueadero.store') }}" method="POST" class="w3-container">
                @csrf



                <p>
                    <label class="w3-text-grey"><b>Placa - Serial del vehículo</b></label>
                    <a class="btn_eliminar" href="">Registrar</a>
                    <input class="w3-input w3-border" id="placa" required maxlength="50" name="placa" type="text" />
                </p>

                <div id="respuesta">
                    <h5 id="campo"></h5>
                </div>
                <div id="opciones">
                    <p>
                        <label class="w3-text-grey"><b>Seleccione parqueadero</b></label>
                        <select class="w3-select w3-border" name="parqueadero" required id="select"> </select>
                    </p>
                    <p>
                        <button class="w3-btn w3-blue">Ingresar vehículo</button>
                    </p>
                </div>
            </form>
        </div>
    </div>

    @if (session('respuesta'))
        <div class="w3-panel w3-pale-green w3-border">
            <p>{{ session('respuesta') }}</p>
        </div>
    @endif

    <!-- parqueadero -->
    <br />
    <div class="w3-card-4 parqueadero">
        <div class="w3-container w3-dark-grey">
            <h3>Parqueaderos</h3>
        </div>

        <div class="autos">
            @foreach ($automoviles as $dato)
                <?php if ($dato['estado'] == 'Disponible'): ?>
                <div class="cubiculo">
                    <span> <?php echo $dato['parqueadero']; ?></span>
                </div>
                <?php else: ?>
                <div class="tooltip cubiculoOcupado">
                    <span> Placa: <?php echo $dato['placa']; ?> </span>
                    <div class="tooltiptext">
                        <p>Parqueadero: <?php echo $dato['parqueadero']; ?> </p>
                        <p>Nombre: <?php echo $dato['cliente']['nombre']; ?> </p>
                        <p>Apellidos: <?php echo $dato['cliente']['apellidos']; ?> </p>
                        <p>N° Documento: <?php echo $dato['cliente']['numero_documento']; ?>
                        </p>
                        <hr />

                        <input type="submit" onclick="abrir_modal_mover('{{ $dato['id'] }}', '{{ $dato['parqueadero'] }}')"
                            class="w3-button w3-blue" value="Mover" />

                        <hr />
                        <form action="{{ url('/parqueaderos/' . $dato['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Terminar servicio" class="w3-button w3-red" />
                        </form>
                    </div>
                </div>
                <?php endif; ?>
            @endforeach
            <div class="restaurar"></div>
        </div>

        <div class="bicicletas">
            @foreach ($bicicletas as $dato)

                <?php if ($dato['estado'] == 'Disponible'): ?>
                <div class="cubiculo">
                    <span> <?php echo $dato['parqueadero']; ?></span>
                </div>
                <?php else: ?>
                <div class="tooltip cubiculoOcupado">
                    <span> Placa: <?php echo $dato['placa']; ?> </span>
                    <div class="tooltiptext">
                        <p>Parqueadero: <?php echo $dato['parqueadero']; ?> </p>
                        <p>Nombre: <?php echo $dato['cliente']['nombre']; ?> </p>
                        <p>Apellidos: <?php echo $dato['cliente']['apellidos']; ?> </p>
                        <p>N° Documento: <?php echo $dato['cliente']['numero_documento']; ?>
                        </p>
                        <hr />
                        <input type="button" id="mover"
                            onclick="abrir_modal_mover('{{ $dato['id'] }}', '{{ $dato['parqueadero'] }}')"
                            class="w3-button w3-blue" value="Mover" />
                        <hr />
                        <form action="{{ url('/parqueaderos/' . $dato['id']) }}" method="POST">
                            <input type="submit" value="Terminar servicio" class="w3-button w3-red" />
                        </form>
                    </div>
                </div>

                <?php endif; ?>

            @endforeach
            <div class="restaurar"></div>
        </div>

        <div class="motos">
            @foreach ($motos as $dato)

                <?php if ($dato['estado'] == 'Disponible'): ?>
                <div class="cubiculo">
                    <span> <?php echo $dato['parqueadero']; ?></span>
                </div>
                <?php else: ?>
                <div class="tooltip cubiculoOcupado">
                    <span> Placa: <?php echo $dato['placa']; ?> </span>
                    <div class="tooltiptext">
                        <p>Parqueadero: <?php echo $dato['parqueadero']; ?> </p>
                        <p>Nombre: <?php echo $dato['cliente']['nombre']; ?> </p>
                        <p>Apellidos: <?php echo $dato['cliente']['apellidos']; ?> </p>
                        <p>N° Documento: <?php echo $dato['cliente']['numero_documento']; ?>
                        </p>
                        <hr />
                        <input type="button" id="mover"
                            onclick="abrir_modal_mover('{{ $dato['id'] }}', '{{ $dato['parqueadero'] }}')"
                            class="w3-button w3-blue" value="Mover" />
                        <hr />
                        <form action="{{ url('/parqueaderos/' . $dato['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Terminar servicio" class="w3-button w3-red" />
                        </form>
                    </div>
                </div>

                <?php endif; ?>

            @endforeach
            <div class="restaurar"></div>
        </div>


    </div>

    <!-- Modal mover  -->
    <div id="id01" class="w3-modal">
        <div class="w3-modal-content">
            <header class="w3-container w3-light-grey">
                <span id="cerrar_modal" class="w3-button w3-display-topright">&times;</span>
                <h2>Nuevo Parqueadero</h2>
            </header>
            <div class="w3-container">
                <form action="{{ url('/parqueaderos/') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <p>
                        <label class="w3-text-grey"><b>Parqueadero</b></label>
                        <input type="hidden" id="parqueadero_viejo" name="parqueadero_viejo">
                        <select class="w3-select w3-border" required id="parqueadero_nuevo" name="parqueadero_nuevo">
                        </select>
                    </p>
                    <p>
                        <button type="submit" class="w3-btn w3-blue">Mover vehículo</button>
                    </p>
                </form>
            </div>
        </div>
    </div>

@endsection


<script>
    function iniciar() {
        //establecer evento de tecla al campo placa
        document.getElementById("placa").addEventListener("keyup", consultar);
        //ocultar respuestas
        document.getElementById('respuesta').style.display = 'none';
        document.getElementById('opciones').style.display = 'none';

        //mover vehiculo
        document.getElementById("cerrar_modal").addEventListener("click", cerrar_modal);
        var parqueadero_viejo = '';
    }

    function consultar() {
        //obtener valor de la placa
        var placa = document.getElementById("placa").value;
        var respuesta = document.getElementById("respuesta");
        var opciones = document.getElementById("opciones");
        var mensaje = '';

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (placa.length > 0) {
                    var json = JSON.parse(this.responseText);
                    if (json.mensaje == null) {
                        document.getElementById('respuesta').style.display = 'none';
                        document.getElementById('opciones').style.display = 'block';
                        var select = document.getElementById("select");
                        var datos = json.datos;
                        for (var i = 0; i < datos.length; i++) {
                            select.options[i] = new Option(datos[i].parqueadero);
                        }
                    } else {
                        document.getElementById('respuesta').style.display = 'block';
                        document.getElementById('campo').innerHTML = json.mensaje;
                        document.getElementById('opciones').style.display = 'none';
                    }

                } else {
                    document.getElementById('respuesta').style.display = 'none';
                }

            }
        };
        url = "{{ url('/parqueaderos') }}" + '/' + placa;
        xhttp.open("GET", "" + url + "", true);
        xhttp.send();
    }
    //abrir el modal y la funcion ajax
    function abrir_modal_mover(id, parqueadero) {
        url = "{{ url('/parqueadero') }}" + '/' + id;
        var solicitud = new XMLHttpRequest();
        solicitud.addEventListener("load", llenar_select);
        solicitud.open("GET", url, true);
        solicitud.send(null);
        parqueadero_viejo = parqueadero;
        document.getElementById("parqueadero_viejo").value = parqueadero_viejo;
    }

    function llenar_select(evento) {
        var datos = evento.target;
        if (datos.status == 200) {
            var parqueadero_nuevo = document.getElementById("parqueadero_nuevo");
            var json = JSON.parse(datos.responseText);
            var datos = json.datos;
            for (var i = 0; i < datos.length; i++) {
                parqueadero_nuevo.options[i] = new Option(datos[i].parqueadero);
            }
        }
        document.getElementById('id01').style.display = 'block';
    }

    function cerrar_modal() {
        document.getElementById('id01').style.display = 'none';
    }

    window.addEventListener("load", iniciar);

</script>
