<?php

session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: ./iniciarsesion.php");
}
if ($_SESSION['permisos'] != 2) {
    header("Location: ./");
}

include "./classes/Db.classes.php";
include "./classes/Users.classes.php";
include "./classes/Users-view.classes.php";



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nomenclaturas</title>
</head>

<body>
    <a href="./">Inicio</a>

    <h3>Agregar unidades ejecutoras</h3>
    <form id="agregarUnidades" method="POST">
        <div>
            <label for="numero">Numero</label>
            <input type="text" class="numero" id="numero">
        </div>
        <div>
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombreUnidad">
        </div>
        <div>
            <label for="abreviatura">Abreviatura</label>
            <input type="text" id="abreviaturaUnidad">
        </div>
        <div>
            <button type="submit" name="submit" type="button">Agregar</button>
        </div>
        <div id="tablaUnidades">
            <?php
            require_once "./includes/tableUnidades.inc.php"
            ?>
        </div>
    </form>

    <h3>Agregar Oficinas</h3>
    <form id="agregarOficinas" method="POST">
        <div id="selectUnidades">
            <?php
            require_once "./includes/selectUnidades.inc.php" ?>
        </div>
        <div>
            <label for="nombreOficina">Nombre</label>
            <input type="text" class="form-control" id="nombreUnidad">
        </div>
        <div>
            <label for="abreviaturaOficina">Abreviatura</label>
            <input type="text" id="abreviaturaUnidad">
        </div>
        <div>
            <button type="submit" name="submit" type="button">Agregar</button>
        </div>
        <div id="tablaUnidades">
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script>
        $("#agregarUnidades").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "./includes/unidad.inc.php",
                //dataType: "json",
                data: {
                    numero: $("#numero").val(),
                    nombre: $("#nombreUnidad").val(),
                    abreviatura: $("#abreviaturaUnidad").val()
                },
                success: function(e) {

                    update()
                    alert(e)
                }
            });
        });



        function update() {
            $.ajax({
                type: "post",
                url: "./includes/tableUnidadesAjax.inc.php",
                success: function(response) {
                    $('#tablaUnidades').html(response);
                }
            });
            $.ajax({
                type: "post",
                url: "./includes/selectUnidadesAjax.inc.php",
                success: function(response) {
                    $('#selectUnidades').html(response);
                    console.log(response)
                }
            });

        }
    </script>
</body>

</html>