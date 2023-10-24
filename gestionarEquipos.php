<?php

session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: ./iniciarsesion.php");
}

header('Content-Type: text/html; charset=UTF-8');


include "./classes/Db.classes.php";
include "./classes/Equipo.classes.php";
include "./classes/Equipo-view.classes.php";

$equipos = new EquipoView();
$equiposList = $equipos->fetchAllEquipos();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/table.css">
    <link rel="stylesheet" href="./css/equiposTabla.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./img/favicon.ico">
    <title>Gestionar equipos</title>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

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
        <section class="tableSection">
            <div class="encabezado">
                <h2 class="titulo">Listado de equipos</h2>
                <div class="coso">
                    <a href="./equiposBaja.php" class="dt-buttons aBaja" >
                        <button class="bajaBoton">
                            Equipos dados de Baja
                        </button>
                    </a>
                </div>
            </div>
            <table id="myTable">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nserie</th>
                        <th>Telefono</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Usuario</th>
                        <th>Nombre PC</th>
                        <th>Fecha</th>
                        <th>IdInventario</th>
                        <th>SO</th>
                        <th>Tipo</th>
                        <th>Modelo</th>
                        <th>Observaciones</th>
                        <th>UE</th>
                        <th>Area</th>
                        <th>tecnico</th>
                        <th>Ver</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($equiposList as $equipo) {
                    ?>
                        <tr>
                            <td><?= $equipo['ID'] ?></td>
                            <td><?= $equipo['NSerie'] ?></td>
                            <td><?= $equipo['Telefono'] ?></td>
                            <td><?= $equipo['Nombre'] ?></td>
                            <td><?= $equipo['Apellido'] ?></td>
                            <td><?= $equipo['Usuario'] ?></td>
                            <td><?= $equipo['NombrePC'] ?></td>
                            <td><?= $equipo['Fecha'] ?></td>
                            <td><?= $equipo['IdInventario'] ?></td>
                            <td><?= $equipo['SistemaOp'] ?></td>
                            <td><?= $equipo['TipoEquipo'] ?></td>
                            <td><?= $equipo['Modelo'] ?></td>
                            <td><?= $equipo['Observaciones'] ?></td>
                            <td><?= $equipo['ue'] ?></td>
                            <td><?= $equipo['oficina'] ?></td>
                            <td><?= $equipo['nombreTecnico'] ?></td>
                            <td><a href="./equipo.php?id=<?= $equipo['ID'] ?>">Ver</a></td>

                        </tr>
                    <?php } ?>
                </tbody>

            </table>
        </section>
    </article>


    <script>
        $(document).ready(function() {
            $('#myTable').dataTable({
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

</body>

</html>