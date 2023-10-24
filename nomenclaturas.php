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

header('Content-Type: text/html; charset=utf8:');


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/nomenclaturas.css">
    <link rel="stylesheet" href="./css/form.css">
    <link rel="stylesheet" href="./css/table.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./img/favicon.ico">
    <title>Nomenclaturas</title>
</head>

<body>
    <?php
    require "./includes/header.inc.php";
    ?>

    <div class="volver">
        <a href="./">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
            </svg>
        </a>
    </div>

    <article class="article">
        <div class="nomenclaturas">

            <div class="izquierda">
                <h2 class="titulo">Agregar unidades ejecutoras</h2>

                <form id="agregarUnidades" method="POST">
                    <div style="grid-area: numero;">
                        <label for="numero">Numero</label>
                        <input required autocomplete="off" min="0" type="number" min="1" class="numero" id="numero">
                    </div>
                    <div style="grid-area: nombre;">
                        <label for="nombre">Nombre</label>
                        <input autocomplete="off" required type="text" id="nombreUnidad">
                    </div>
                    <div style="grid-area: abreviatura;">
                        <label for="abreviatura">Abreviatura</label>
                        <input autocomplete="off" required type="text" id="abreviaturaUnidad">
                    </div>
                    <div style="grid-area: boton;">
                        <button type="submit" name="submit" type="button">Agregar</button>
                    </div>

                </form>
                <h3 class="subtitulo">Unidades ejecutoras</h3>

                <div id="tablaUnidades">
                    <?php
                    include "./includes/tableUnidadesReq.inc.php"
                    ?>
                </div>

            </div>


            <div class="derecha">

                <h2 class="titulo">Agregar Oficinas</h2>

                <form id="agregarOficinas" method="POST">
                    <div style="grid-area: numero;">
                        <label for="select">Unidad ejecutora</label>
                        <select required autocomplete="off name=" selectUnidades" id="select">
                            <?php
                            include "./includes/selectUnidadesReq.inc.php"
                            ?>
                        </select>
                    </div>
                    <div style="grid-area: nombre;">
                        <label for="nombreOficina">Nombre</label>
                        <input required autocomplete="off" type="text" id="nombreOficina">
                    </div>
                    <div style="grid-area: abreviatura;">
                        <label for="abreviaturaOficina">Abreviatura</label>
                        <input required autocomplete="off" type="text" id="abreviaturaOficina">
                    </div>
                    <div style="grid-area: boton;">
                        <button type="submit" name="submit" type="button">Agregar</button>
                    </div>
                </form>

                <h3 class="subtitulo">Oficinas</h3>

                <div id="tablaOficinas">
                    <?php
                    include "./includes/tableOficinasReq.inc.php"
                    ?>
                </div>

            </div>

        </div>
    </article>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#unidadesReq').dataTable({
                "pageLength": 100,
                dom: 'Bfrtip',
                buttons: [
                    'colvis',
                    'excel',
                ]
            });
            $('#oficinasReq').dataTable({
                "pageLength": 100,
                dom: 'Bfrtip',
                buttons: [
                    'colvis',
                    'excel',
                ]
            });
        });
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.2/b-2.3.4/b-html5-2.3.4/b-print-2.3.4/datatables.min.js"></script>
    <script src="./js/nomenclaturas.js"></script>
</body>

</html>