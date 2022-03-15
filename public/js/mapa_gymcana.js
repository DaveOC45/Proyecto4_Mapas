// Cmabiar iconos de mapa, poner un poco mejor los botones, css general y poner iconos de fontsawesome
/* Objetode Ajaz*/


function objetoAjax() {
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

/* Obtener posicion en coordeandas delsuaurio mediante navegador*/
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(iniciarPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
var map

/* Mostrar en el mapa la posición del usuario */
function iniciarPosition(position) {
    myPosition = position;
    var container = L.DomUtil.get('map');
    if (container != null) {
        container._leaflet_id = null;
        map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 25);

        //Añadimos un poligono con nuetsra zona de juego
        var polygon = L.polygon([
            [41.374980592155794, 2.168069419305712],
            [41.37870230182673, 2.1630370312774074],
            [41.385554535803344, 2.1641276580851647],
            [41.385925684055444, 2.1647233874574145],
            [41.38557028059483, 2.1697256305596704],
            [41.38581837319181, 2.170128191724144],
            [41.388490777066735, 2.172788943197472],
            [41.3804088341541, 2.1835177788932114],
            [41.37675392055456, 2.184976900593031],
            [41.37432256476872, 2.18298133728499],
            [41.37515986311363, 2.1815222157264222],
            [41.37749458041587, 2.1831959139847794],
            [41.37952330119203, 2.1823376071856218],
            [41.37400052401823, 2.17798170011355],
            [41.37155296263436, 2.1830027948886213],
            [41.37039355931067, 2.182037199739569],
            [41.37363017524818, 2.1753853220460986],
            [41.374048830224076, 2.1753853220460986],
            [41.37445138054452, 2.175256576026225]
        ]).addTo(map);
    }
    var florentino = L.icon({
        iconUrl: 'http://assets.stickpng.com/images/5c41d5a7e39d5d01c21da92a.png',
        iconSize: [60, 60]
    });

    var marker = L.marker([position.coords.latitude, position.coords.longitude], { draggable: false, autoPan: false, icon: florentino }).addTo(map);
    var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 16,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
    }).addTo(map);
}

var routing = '';
var been_routed = false;

function crearRuta(latitud, longitud) {
    var boton_ruta = document.getElementById('golito')
    console.log(boton_ruta)
    console.log(boton_ruta)

    users_lat_coords = myPosition.coords.latitude;
    users_lng_coords = myPosition.coords.longitude;
    x = latitud;
    y = longitud;

    if (x !== '') {
        if (been_routed === true) {
            routing.spliceWaypoints(0, 1);
        }
        routing = L.Routing.control({
            waypoints: [L.latLng(users_lat_coords, users_lng_coords), L.latLng(x, y)],
            lineOptions: { addWaypoints: false },
            show: false,
            addWaypoints: false, //Quitamos opciones de desviaciones
            routeWhileDragging: false,
            draggableWaypoints: false, //Esto es tonteria, pero es quita los drags de rutas alternativas
            fitSelectedRoutes: false,
            createMarker: function() { return null; }

        });
        routing.addTo(map);
        been_routed = true;
    }
}


function empezargimcana(id_gimcana) {
    console.log(id_gimcana)
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('id_gimcana', id_gimcana)
        /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();
    ajax.open("post", "inicializargimcana", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            console.log(respuesta)
            localizarpuntoscontrol(respuesta[2])

        }
    }
    ajax.send(formData);
}
empezargimcana(1)

function localizarpuntoscontrol(direccionesgimcana) {
    dentromarker = [];
    var geocoder = L.esri.Geocoding.geocodeService();
    for (let i = 0; i < direccionesgimcana.length; i++) {
        console.log(direccionesgimcana[i])
        geocoder.geocode().text(direccionesgimcana[i].direccion_ubicacion).run(function(error, response) {
            dentromarker.push(L.marker(response.results[0].latlng).addTo(map));
        });
    }
}