<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device=width, initial-scale=1.0">
    <link rel="stylesheet" href="{!! asset('css/styles.css') !!}">
    <script src="{!! asset('js/validacion.js') !!}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/x-icon" href="{{asset('storage/uploads/logoblanco.png')}}">
    <title>Registro</title>
</head>
<body class="login">
    <div class="row flex-cv">
        <div class="cuadro_login">
            <form action="{{url('registroPost')}}" method="POST" onsubmit="return validarRegistro()">
            @csrf
            <h1 class="h1_register">REGISTRO DE USUSARIO</h1>
            <input class="input_login" type="text" id="correo_usuario" name="correo_usuario" placeholder="Introduce el email..." value="{{old('email')}}">
            <input class="input_login" type="password" id="password_usuario" name="password_usuario" placeholder="Introduce la contraseña...">
            <input class="input_login" type="password" id="password_usuario_validar" name="password_usuario_validar" placeholder="Vuelve a introducir la contraseña...">
            <div>
                @error('correo_usuario')
                    <input type="hidden" id="error" name="tipo" value="errormio">
                    <script>
                        window.onload = function(){
                            validarCorreo();
                        }
                    </script>

                @enderror
                <input type="hidden" id="error" name="tipo" value="noerror">
                <input type="hidden" name="tipo" value="2">
                <input class="input_registro" type="submit" value="Registrarme">
            </div>
            </form>
            <button class="boton_login" OnClick="location.href='./login'">Volver al incio de sesión</button>
        </div>
    </div>
</body>
</html>
