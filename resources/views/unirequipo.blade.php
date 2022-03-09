<!DOCTYPE HTML>
<html>
<head>
    <title>Unirse a un equipo</title>
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
        <h1>Unirse a un equipo</h1>
        <form action="{{url('unirequipoPOST')}}" method="POST" onsubmit="return validarUnirEquipo();">
          @csrf
          {{method_field('POST')}}
          <input class="input_login" type="text" id="nombreequipo" name="nombreequipo" placeholder="Nombre de equipo">
          <input class="input_login" type="text" id="codigo" name="codigo" placeholder="Codigo de equipo">
          @error('nombreequipo')
            <input type="hidden" id="error" name="tipo" value="errormio">
            <script>
                window.onload = function(){
                    validarUnirEquipo();
                }
            </script>
          @enderror
          <input type="hidden" id="error" name="tipo" value="noerror">
          <button class="boton_registro" OnClick="location.href='./jugargimcana2'">Unirme al equipo</button>
        </form>
        <button class="boton_registro" OnClick="location.href='./gimcanaequipos'">Volver atras</button>
    </div>
  </div>
</body>
</html>