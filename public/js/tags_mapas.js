function obtenerTagsBBDD() {
    console.log("te voy a mostrar las categorias de las ubicaciones de la BBDD")

    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));

    /* Inicializar un objeto AJAX */
    var ajax = objetoAjax();
    ajax.open("get", "mostrar_tags_ubicaciones", true);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            console.log(respuesta)
            return respuesta;
        }
    }
    ajax.send(formData);

}