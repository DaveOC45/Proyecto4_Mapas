
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
    <script src="../js/tags_mapas.js"></script>
    <script src="../js/mapa_filtro.js"></script>
    <script src="../js/llamada_ajax.js"></script>
    

    <link rel="stylesheet" href="../css/style.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" id="token">
    <title>Agenda Churrerías</title>

</head>
<body onload="getLocation(); obtenerTagsBBDD();">
    
    <button onclick="ponerLayers();">Mostrar todo</button>
    <button onclick="mostrarUbicacion('Restaurante');"> Pon rest como layer</button>
    <div id="tags"></div>
    <div id="traduccion"></div>

    <div id="map" style="width: 414px;height:896px;"></div>

</body>
</html>