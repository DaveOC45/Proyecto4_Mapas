@if (!Session::get('nombre_user'))
    <?php
        //Si la session no esta definida te redirige al login.
        return redirect()->to('/')->send();
    ?>
@endif
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Enlace a API para hacer el CSS de los Mapas  -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <!-- Enlace a API para hacer la logica general de los mapas  -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

    
    <!--INICIO POSIBLE PRESCINDIBLE -->
    <!-- Esri Leaflet Geocoder 

        CREO QUE ESTOS DOS ENLACES SON PRESCINDIBLES

    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css" />
    <script src="https://unpkg.com/esri-leaflet-geocoder"></script>

    -->
    <!--FINAL POSIBLE PRESCINDIBLE -->


    <!-- Enlace a API para hacer el geocoding NO TOCAR  -->
    <script src="https://unpkg.com/esri-leaflet"></script>

    <!-- Enlace a API para hacer el geocidng Direcciones <-> Coordanedadas  NO TOCAR -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet.esri.geocoder/2.1.0/esri-leaflet-geocoder.css">
    <script src="https://cdn.jsdelivr.net/leaflet.esri.geocoder/2.1.0/esri-leaflet-geocoder.js"></script>
    
    <!-- Enlace a API para hacer el routing NO TOCAR -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
    
    <!-- JS PROPIOS -->
    {{-- <script src="{!! asset('js/validacion.js') !!}"></script> --}}

    {{-- <script src="{!! asset('js/tags_mapas.js') !!}"></script> --}}
    
    <script src="{!! asset('js/llamada_ajax.js') !!}"></script>
    

    <link rel="stylesheet" href="{!! asset('css/style.css') !!}">
    <meta name="csrf-token" content="{{ csrf_token() }}" id="token">
    <title>GIMCANA</title>

</head>

<body>
    {{-- lo de pillar la sesión en hidden es para hacer lo de favoritos --}}
    {{-- <input type="number" id="id_user" value="{{Session::get('id_user')}}" hidden> --}}
    <input hidden type="number" id="id_pregunta" name="tipo" value=0>
    <input type="hidden" id="error" name="tipo" value="errormio">
    <button class="boton_login" OnClick="location.href='./gimcana'">EMPEZAR</button>
    <button class="boton_login" OnClick="location.href='./logout'">Logout</button>
    <button class="boton_login" OnClick="location.href='./mapa'">Volver al mapa</button>
    {{-- <button class="btn" id="anadir_filtros"  onclick="ponerLayers();">Añadir filtros por capas/grupo</button>
    <button class="btn" id="anadir_favoritos" onclick="ponerFavoritos();">Añadir filtro favoritos</button> --}}
    <div id="tags"></div>
    <div id="traduccion"></div>

    <div id="map" style="width: 414px;height:896px;"></div>

    
    <p id="resultado_actual">Aqui verás si estás fuera del punto de control</p>
    <button hidden id="pasar_punto_control">Pasar de punto de control</button>

</body>
<script src="{!! asset('js/mapa_gymcana.js') !!}"></script>
</html>