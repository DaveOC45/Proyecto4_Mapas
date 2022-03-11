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

/* Obtenemos todas las posiciones favoritas en BBDD y llamamos a que nos la ponga*/
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
            //console.log(respuesta)
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
                        var markerIcon = L.icon({
                                //Fotos de la carpeta proyecto
                                //iconUrl: 'media/icon/' + respuesta[i].path_ic,
                                iconSize: [20, 20],
                                iconAnchor: [20, 20],
                                popupAnchor: [10, 10],
                                className: 'redIcon'
                            })
                            //nombre direccion descripcion opiinion opinion_user foto + add favorito
                        var user = document.getElementById('id_user').value
                        var markerIconPopup = L.popup().setContent(
                            '<center><h3>' + datos[i]['nombre_ubicacion'] + '</h3>' +
                            '<p>' + datos[i]['direccion_ubicacion'] + '</p>' +
                            '<p>' + datos[i]['descripcion_ubicacion'] + '</p>' +
                            '<img width=100px height=100px src="storage/' + datos[i]['foto_ubicacion'] + '"></img><br>' +
                            '<button onclick="anadirFav(' + user + ',' + datos[i]['id_ubicacion'] + ')">' + 'Añadir a favoritos' + '</button>' +
                            '<button>' + 'Crear ruta?' + '</button>' +
                            '<p id="info_insercion"></p>' +
                            '</center>'

                        );
                        markerPosition.push(L.marker(response.results[i].latlng).on("click", muestraPopup, { icon: markerIcon }).bindPopup(markerIconPopup).addTo(markerGroup_1));
                    });
                }
                if (datos[i]['id_tipo'] == 2) {
                    geocoder.geocode().text(datos[i].direccion_ubicacion).run(function(error, response) {

                        var markerIcon = L.icon({
                            //Fotos de la carpeta proyecto
                            //iconUrl: 'media/icon/' + respuesta[i].path_ic,
                            iconSize: [20, 20],
                            iconAnchor: [20, 20],
                            popupAnchor: [10, 10]
                        })
                        var user = document.getElementById('id_user').value
                        var markerIconPopup = L.popup().setContent(
                            '<center><h3>' + datos[i]['nombre_ubicacion'] + '</h3>' +
                            '<p>' + datos[i]['direccion_ubicacion'] + '</p>' +
                            '<p>' + datos[i]['descripcion_ubicacion'] + '</p>' +
                            '<img width=100px height=100px src="storage/' + datos[i]['foto_ubicacion'] + '"></img><br>' +
                            '<button onclick="anadirFav(' + user + ',' + datos[i]['id_ubicacion'] + ')">' + 'Añadir a favoritos' + '</button>' +
                            '<button>' + 'Crear ruta?' + '</button>' +
                            '<p id="info_insercion"></p>' +
                            '</center>'

                        );
                        markerPosition.push(L.marker(response.results[0].latlng).on("click", muestraPopup, { icon: markerIcon }).bindPopup(markerIconPopup).addTo(markerGroup_2));
                        //markerPosition.push(L.marker(response.results[i].latlng).on("click", muestraPopup, { icon: markerIcon }).bindPopup(markerIconPopup).addTo(markerGroup_favorito));

                    });
                }
                if (datos[i]['id_tipo'] == 3) {
                    geocoder.geocode().text(datos[i].direccion_ubicacion).run(function(error, response) {
                        var markerIcon = L.icon({
                            //Fotos de la carpeta proyecto
                            //iconUrl: 'media/icon/' + respuesta[i].path_ic,
                            iconSize: [20, 20],
                            iconAnchor: [20, 20],
                            popupAnchor: [10, 10]
                        })
                        var user = document.getElementById('id_user').value
                        var markerIconPopup = L.popup().setContent(
                            '<center><h3>' + datos[i]['nombre_ubicacion'] + '</h3>' +
                            '<p>' + datos[i]['direccion_ubicacion'] + '</p>' +
                            '<p>' + datos[i]['descripcion_ubicacion'] + '</p>' +
                            '<img width=100px height=100px src="storage/' + datos[i]['foto_ubicacion'] + '"></img><br>' +
                            '<button onclick="anadirFav(' + user + ',' + datos[i]['id_ubicacion'] + ')">' + 'Añadir a favoritos' + '</button>' +
                            '<button>' + 'Crear ruta?' + '</button>' +
                            '<p id="info_insercion"></p>' +
                            '</center>'

                        );
                        markerPosition.push(L.marker(response.results[0].latlng).on("click", muestraPopup, { icon: markerIcon }).bindPopup(markerIconPopup).addTo(markerGroup_3));
                    });
                }


            }
            console.log(markerGroup)

            //var markerGroup = L.layerGroup().addTo(map);
            var overlayMaps = {};
            //id_tipo = datos[0]['id_tipo']
            nombreCapa = ""
            for (let i = 0; i < tipos.length; i++) {
                //console.log(tipos[i])
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

function muestraPopup(objeto_clickado) {

    console.log(objeto_clickado)
    var id_ubicacion = objeto_clickado['sourceTarget']['_events']['click'][0]['ctx']['id_ubicacion']
    console.log("Este es mi id, me has clickado " + id_ubicacion)

}

/* Geolocalizar posiciones favoritas mediante direcciones */
function positionDirectionFavorita(datos) {

    console.log(datos)
    var geocoder = L.esri.Geocoding.geocodeService();

    var markerGroup_favorito = L.layerGroup()

    markerPosition = [];
    var markerGroup_favorito = L.layerGroup()
    removeRouting = false;
    for (let i = 0; i < datos.length; i++) {
        geocoder.geocode().text(datos[i].direccion_ubicacion).run(function(error, response) {
            console.log(response.results[0])
            var markerIcon = L.icon({
                    //Fotos de la carpeta proyecto
                    //iconUrl: 'media/icon/' + respuesta[i].path_ic,
                    iconSize: [20, 20],
                    iconAnchor: [20, 20],
                    popupAnchor: [10, 10],
                    className: 'redIcon'
                })
                //nombre direccion descripcion opiinion opinion_user foto + add favorito
            var user = document.getElementById('id_user').value
            var markerIconPopup = L.popup().setContent(
                '<center><h3>' + datos[i]['nombre_ubicacion'] + '</h3>' +
                '<p>' + datos[i]['direccion_ubicacion'] + '</p>' +
                '<p>' + datos[i]['descripcion_ubicacion'] + '</p>' +
                '<img width=100px height=100px src="storage/' + datos[i]['foto_ubicacion'] + '"></img><br>' +
                //'<button onclick="anadirFav(' + user + ',' + datos[i]['id_ubicacion'] + ')">' + 'Añadir a favoritos' + '</button>' +
                '<button>' + 'Crear ruta?' + '</button>' +
                '<p id="info_insercion"></p>' +
                '</center>'

            );
            markerPosition.push(L.marker(response.results[0].latlng).on("click", muestraPopup, { icon: markerIcon }).bindPopup(markerIconPopup).addTo(markerGroup_favorito));
        });
    }
    //console.log(markerGroup_favorito)

    //var markerGroup = L.layerGroup().addTo(map);
    var overlayMaps = {};
    //id_tipo = datos[0]['id_tipo']
    nombreCapa = "Favoritos"
    overlayMaps[nombreCapa] = markerGroup_favorito

    L.control.layers(null, overlayMaps, { collapsed: false }).addTo(map);

}

//hacer ajax de unir favoritos
function anadirFav(id_user, id_ubicacion) {

    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    formData.append('id_user', id_user)
    formData.append('id_ubicacion', id_ubicacion)
        /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();
    ajax.open("post", "anadir_favoritos", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            //console.log(respuesta['Resultado'])
            informacion = document.getElementById('info_insercion')
            if (respuesta['Resultado'] == 'NOK') {
                informacion.innerHTML = "Esta ubicacion ya la has añadido a favoritos"
            } else {
                informacion.innerHTML = "Ubicación añadida a favoritos"
            }
        }
    }
    ajax.send(formData);
}


/* Creador de Rutas hasta los markers seleccionados  */
function getPositionDirection(e) {


    //routingControl.spliceWaypoints(0, 2); // <-- removes your rout

    routingControl = L.Routing.control({
        waypoints: [

            L.latLng(myPosition.coords.latitude, myPosition.coords.longitude),
            L.latLng(e.latlng.lat, e.latlng.lng)

        ],
        show: false,
        addWaypoints: false, //Quitamos opciones de desviaciones
        routeWhileDragging: false,
        draggableWaypoints: false, //Esto es tonteria, pero es quita los drags de rutas alternativas
        fitSelectedRoutes: false
    }).addTo(map);
}
/*
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
*/