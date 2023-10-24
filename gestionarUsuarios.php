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

$users = new UsersView();
$usersList = $users->fetchAllUsers();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/table.css">
    <link rel="stylesheet" href="./css/registrarEquipos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./img/favicon.ico">
    <title>Gestionar usuarios</title>
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
        <section class="tableSection">
            <h2 class="titulo">Listado de usuarios</h2>
            <table id="myTable">
                <thead>
                    <tr>
                        <th>Ci</th>
                        <th>Mail</th>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Permisos</th>
                        <th>Fecha de Creacion</th>
                        <th>Ver</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($usersList as $user) {
                    ?>
                        <tr>
                            <td><?= $user['ci'] ?></td>
                            <td><?= $user['mail'] ?></td>
                            <td><?= $user['user'] ?></td>
                            <td><?= $user['nombre'] ?></td>
                            <td><?= $user['apellido'] ?></td>
                            <td><?= $user['permisos'] ?></td>
                            <td><?= $user['FechaCreacion'] ?></td>
                            <td><a href="./usuario.php?ci=<?= $user['ci'] ?>">Ver</a></td>

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