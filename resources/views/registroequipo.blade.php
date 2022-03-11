@if (!Session::get('nombre_user'))
    <?php
        //Si la session no esta definida te redirige al login.
        return redirect()->to('/')->send();
    ?>
@endif
<!DOCTYPE HTML>
<html>
<head>
  <title>Crear equipo</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{!! asset('css/styles.css') !!}">
  <script src="{!! asset('js/validacion.js') !!}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="icon" type="image/x-icon" href="{{asset('storage/uploads/logoblanco.png')}}">
</head>
<body class="body_login">
  <div class="row flex-cv">
    <div class="cuadro_login">
        <h1>Crear equipo Gymkhana</h1>
        <form action="{{url('registroPostequipo')}}" method="POST" onsubmit="return validarCrearEquipo();">
            @csrf
            {{method_field('POST')}}
            <!--
            <input class="input_login" type="text" id="nombreequipo" name="nombreequipo" placeholder="Nombre de equipo">
            <input class="input_login" type="text" id="codigo" name="codigo" placeholder="Codigo de equipo">
            <input class="input_login" type="text" id="correo1" name="correo1" placeholder="Correo jugador 1">
            <input class="input_login" type="text" id="correo2" name="correo2" placeholder="Correo jugador 2">-->
            <h1 class="h1_register">REGISTRO DE EQUIPO</h1>
            <h2>nombre equipo</h2>
            <input class="input_login" type="text" id="nombre_equipo" name="nombre_equipo" placeholder="Introduce el nombre del equipo...">
            <h2>codigo equipo</h2>
            <input class="input_login" type="text" id="codigo_equipo" name="codigo_equipo" placeholder="Introduce el codigo del equipo...">
            <input class="input_login" type="hidden" id="correo_usuario1" name="correo_usuario1" value={{Session::get('nombre_user')}}>
            <h2>2 participante equipo</h2>
            <input class="input_login" type="text" id="correo_usuario2" name="correo_usuario2" placeholder="Introduce el correo del segundo usuario">
            <h2>3 participante equipo</h2>
            <input class="input_login" type="text" id="correo_usuario3" name="correo_usuario3" placeholder="Introduce el correo del tercer usuario">
            <div>
            @error('nombreequipo')
              <input type="hidden" id="error" name="tipo" value="errormio">
              <script>
                  window.onload = function(){
                      validarCrearEquipo();
                  }
              </script>
            @enderror
            <input type="hidden" id="error" name="tipo" value="noerror">
            <button class="boton_login" type="submit" name="register" value="register">Crear equipo</button>    
        </form>
        <button class="boton_registro" OnClick="location.href='./gimcanaequipos'">Volver atras</button>
    </div>
  </div>
</body>
</html>
