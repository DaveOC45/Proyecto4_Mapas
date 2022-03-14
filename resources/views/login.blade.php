<!DOCTYPE HTML>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Login</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="{!! asset('css/styles.css') !!}">
</head>
<body class="login">
  <div class="row flex-cv">
    <div class="cuadro_login">
        <form action="{{url('login')}}" method="POST">
            @csrf
            <br>
            <h1>INICIO DE SESIÓN</h1>
            <br>
            <div class="form-group">
                <p>Correo:</p>
                <div>
                    <input class="inputlogin" type="text" name="correo_usuario" placeholder="Introduce tu correo">
                </div>
            </div>
            <br>
            <div class="form-group">
                <p>Contraseña:</p>
                <div>
                    <input class="inputlogin" type="password" name="password_usuario" placeholder="Introduce tu contraseña">
                </div>
            </div>
            
            <br><br>
            <div class="form-group">
                <button class= "botonlogin" type="submit" value="register">Iniciar Sesión</button>
            </div>
        </form>
    </div>
  </div>
</body>
</html>