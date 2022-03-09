//CREAR FUNCION QUE AÑADA CADA LAYER Y TODAS LAS UBICACIONES POR GRUPO, LUEGO VIA CSS SE MODIFICA
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


/* Obtenemos todas las posiciones en BBDD */
function ponerLayers() {

    tag = document.getElementById('anadir_filtros')
    tag.className = 'btnclicked';
    tag.setAttribute("onClick", "");

    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));

    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();
    ajax.open("get", "mapa_filtros_todo", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            //console.log(respuesta)
            return respuesta;
        }
    }
    ajax.send(formData);
    cargaContenido("mapa_filtros_todo", "get", positionDirection)
}

function ponerFavoritos() {

    tag = document.getElementById('anadir_favoritos')
    tag.className = 'btnclicked';
    tag.setAttribute("onClick", "");

    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('user', 1)

    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();
    ajax.open("post", "mapa_filtros_favoritos", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            console.log(respuesta)
            positionDirectionFavorita(respuesta)
                //return respuesta;
        }
    }
    ajax.send(formData);

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
    }

    var marker = L.marker([position.coords.latitude, position.coords.longitude], { draggable: false, autoPan: false }).addTo(map);
    var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 15,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
    }).addTo(map);
}

/* Geolocalizar posiciones mediante direcciones de layers tags */
function positionDirection(e) {
    if (peticion_http.readyState == READY_STATE_COMPLETE) {
        if (peticion_http.status == 200) {
            var datos = JSON.parse(peticion_http.responseText);
            console.log(datos)
            var geocoder = L.esri.Geocoding.geocodeService();

            //CRear un grupo por cada tipo

            var markerGroup_1 = L.layerGroup()
            var markerGroup_2 = L.layerGroup()
            var markerGroup_3 = L.layerGroup()


            /*
            var array_tipos = []

            for (let i = 0; i < datos.length; i++) {
                array_tipos.push(datos[i]['id_tipo']);
            }
            let array_tipos_unicos = array_tipos.filter((item, i, ar) => ar.indexOf(item) === i);
            console.log(array_tipos_unicos);
            */

            markerPosition = [];
            var markerGroup = L.layerGroup()
            removeRouting = false;
            for (let i = 0; i < datos.length; i++) {
                if (datos[i]['id_tipo'] == 1) {
                    geocoder.geocode().text(datos[i].direccion_ubicacion).run(function(error, response) {
                        //console.log(response.results[0])
                        markerPosition.push(L.marker(response.results[0].latlng).on("click", getPositionDirection).addTo(markerGroup_1));
                    });
                }
                if (datos[i]['id_tipo'] == 2) {
                    geocoder.geocode().text(datos[i].direccion_ubicacion).run(function(error, response) {
                        //console.log(response.results[0])
                        markerPosition.push(L.marker(response.results[0].latlng).on("click", getPositionDirection).addTo(markerGroup_2));
                    });
                }
                if (datos[i]['id_tipo'] == 3) {
                    geocoder.geocode().text(datos[i].direccion_ubicacion).run(function(error, response) {
                        //console.log(response.results[0])
                        markerPosition.push(L.marker(response.results[0].latlng).on("click", getPositionDirection).addTo(markerGroup_3));
                    });
                }


            }
            console.log(markerGroup)

            //var markerGroup = L.layerGroup().addTo(map);
            var overlayMaps = {};
            //id_tipo = datos[0]['id_tipo']
            nombreCapa = ""
            for (let i = 0; i < tipos.length; i++) {
                console.log(tipos[i])
                if (tipos[i]['nombre_tipo'] == 'Gimnasio') {
                    nombreCapa = tipos[i]['nombre_tipo']
                    overlayMaps[nombreCapa] = markerGroup_1
                }
                if (tipos[i]['nombre_tipo'] == 'Restaurante') {
                    nombreCapa = tipos[i]['nombre_tipo']
                    overlayMaps[nombreCapa] = markerGroup_2
                }
                if (tipos[i]['nombre_tipo'] == 'Pizzeria') {
                    nombreCapa = tipos[i]['nombre_tipo']
                    overlayMaps[nombreCapa] = markerGroup_3
                }
            }
            L.control.layers(null, overlayMaps, { collapsed: false }).addTo(map);




            //console.log(markerGroup)
            //var overlayMaps = { "Cities": markerGroup };


            //L.control.layers(null, overlayMaps).addTo(map);

            //markerGroup.clearLayers();

        }

    }
}
/* Geolocalizar posiciones mediante direcciones */
function positionDirectionFavorita(datos) {

    console.log(datos)
    var geocoder = L.esri.Geocoding.geocodeService();

    var markerGroup_favorito = L.layerGroup()

    markerPosition = [];
    var markerGroup_favorito = L.layerGroup()
    removeRouting = false;
    for (let i = 0; i < datos.length; i++) {
        geocoder.geocode().text(datos[i].direccion_ubicacion).run(function(error, response) {
            //console.log(response.results[0])
            markerPosition.push(L.marker(response.results[0].latlng).on("click", getPositionDirection).addTo(markerGroup_favorito));
        });
    }
    console.log(markerGroup_favorito)

    //var markerGroup = L.layerGroup().addTo(map);
    var overlayMaps = {};
    //id_tipo = datos[0]['id_tipo']
    nombreCapa = "Favoritos"
    overlayMaps[nombreCapa] = markerGroup_favorito

    L.control.layers(null, overlayMaps, { collapsed: false }).addTo(map);

}

function positionDirectionRemove(e) {
    if (peticion_http.readyState == READY_STATE_COMPLETE) {
        if (peticion_http.status == 200) {
            var datos = JSON.parse(peticion_http.responseText);
            console.log(datos)
            var geocoder = L.esri.Geocoding.geocodeService();
            markerPosition = [];
            //console.log(markerPosition)
            removeRouting = false;
            for (let i = 0; i < datos.length; i++) {
                geocoder.geocode().text(datos[i].direccion_ubicacion).run(function(error, response) {
                    //opciones de geolocalización
                    //console.log(response)
                });
            }
        }
    }
}

/* Creador de Rutas hasta los markers seleccionados  */
function getPositionDirection(e) {
    /*
    if (removeRouting != false) {
        map.removeControl(routingControl);
    } else {
        removeRouting = true;
    }
    */
    routingControl = L.Routing.control({
        waypoints: [

            L.latLng(myPosition.coords.latitude, myPosition.coords.longitude),
            L.latLng(e.latlng.lat, e.latlng.lng)
        ],
        routeWhileDragging: false,
        draggableWaypoints: false,
        fitSelectedRoutes: false
    }).addTo(map);

}

function mostrarUbicacion(tipo) {

    tag = document.getElementById('tag_' + tipo)
    tag.className = 'btnclicked';
    //Tocar esto para dejar de añadir layers
    //tag.setAttribute("onClick", "retirarUbicacion('" + tipo + "');");
    //console.log(tag)

    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));

    var ajax = objetoAjax();
    ajax.open("get", "mapa_filtros/" + tipo, true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            return respuesta;
        }
    }
    ajax.send(formData);
    cargaContenido("mapa_filtros/" + tipo, "get", positionDirection)
}

function retirarUbicacion(tipo) {
    tag = document.getElementById('tag_' + tipo)
        //tag.className = 'btn';
        //tag.setAttribute("onClick", "mostrarUbicacion('" + tipo + "');");
        //console.log(tag)

    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));

    var ajax = objetoAjax();
    ajax.open("get", "mapa_filtros/" + tipo, true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            return respuesta;
        }
    }
    ajax.send(formData);
    cargaContenido("mapa_filtros/" + tipo, "get", positionDirectionRemove)
}