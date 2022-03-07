<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD ADMIN</title>
    <script src="js/ajax.js"></script>
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
</head>
<body>
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        
        /* The Modal (background) */
        .modal {
          display: none; /* Hidden by default */
          position: fixed; /* Stay in place */
          z-index: 1; /* Sit on top */
          padding-top: 100px; /* Location of the box */
          left: 0;
          top: 0;
          width: 100%; /* Full width */
          height: 100%; /* Full height */
          overflow: auto; /* Enable scroll if needed */
          background-color: rgb(0,0,0); /* Fallback color */
          background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }
        
        /* Modal Content */
        .modal-content {
          background-color: #fefefe;
          margin: auto;
          padding: 20px;
          border: 1px solid #888;
          width: 80%;
        }
        
        /* The Close Button */
        .close {
          color: #aaaaaa;
          float: right;
          font-size: 28px;
          font-weight: bold;
        }
        
        .close:hover,
        .close:focus {
          color: #000;
          text-decoration: none;
          cursor: pointer;
        }
        </style>
        <h2>buscaaaaah</h2>

        <!-- Trigger/Open The Modal -->
        
        <!-- The Modal -->
        <div id="myModal" class="modal">
        
          <!-- Modal content -->
          <div class="modal-content">
            <span class="close">&times;</span>
            <form action="" id="formulario" onsubmit="editarJS(); return false">
                <input type="text" name="modnombre" id="modnombre">
                <input type="text" name="moddescripcion" id="moddescripcion">
                <input type="text" name="moddireccion" id="moddireccion">
                <input type="hidden" name="id" id="idModificar" value="">
                <input type="submit" value="modificar">
            </form>
          </div>
        
        </div>
    <input type="text" onkeyup="leerJS()" id="filtro">
    <hr>
    <table id="main">
    </table>
    <hr>
    <form onsubmit="insertarJS(); return false;">
        <p>Nombre</p>
        <input type="text" id="nombre_ubicacion">
        <p>Descripción</p>
        <input type="text" id="descripcion_ubicacion">
        <p>Dirección</p>
        <input type="text" id="direccion_ubicacion">
        <p>foto</p>
        <input type="file" id="foto_ubicacion">
        <p>Tipo de ubicación</p>
        <select  id="nombre_tipo">
        </select>
        <input type="submit">
    </form>
    <hr>
    <p id="mensaje"></p>
    <hr>
</body>
</html>