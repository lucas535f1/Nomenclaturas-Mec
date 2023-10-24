<?php
session_start();
if (!isset($_SESSION['ci'])) {
    header("Location: ./iniciarsesion.php");
} else if ($_SESSION['permisos'] > 2) {
    header("Location: ./");
} else if (!isset($_GET['ci'])) {
    header("Location: ./gestionarUsuarios.php");
}


include "./classes/Db.classes.php";
include "./classes/Users.classes.php";
include "./classes/Users-view.classes.php";
include "./classes/Events.classes.php";
include "./classes/Events-view.classes.php";

$usersView = new UsersView();

if (!$usersView->userExists($_GET['ci'])) {
    header("Location: ./gestionarUsuarios.php");
}

$user = $usersView->fetchUser($_GET['ci']);

$eventsView = new EventsView();
$eventsList = $eventsView->fetchUserEvents($_GET['ci']);

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
    <link rel="stylesheet" href="./css/usuario.css">
    <link rel="stylesheet" href="./css/data.css">
    <link rel="stylesheet" href="./css/table.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./img/favicon.ico">
    <title>Usuario <?= $user['Nombre'] ?> <?= $user['Apellido'] ?></title>
</head>

<body>
    <?php
    require "./includes/header.inc.php";
    ?>

    <div class="volver">
        <a href="./gestionarUsuarios.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
            </svg>
        </a>
    </div>

    <article class="article">
        <section class="dataSection">
            <h2 class="titulo">Usuario</h2>
            <div class="dataContainer">
                <div style="grid-area: ci;">
                    <span class="name">CI:</span>
                    <span class="data"><?= $user['CI'] ?></span>
                </div>

                <div style="grid-area: mail;">
                    <span class="name">Mail:</span>
                    <span class="data"><?= $user['Mail'] ?></span>
                </div>

                <div style="grid-area: usuario;">
                    <span class="name">Usuario:</span>
                    <span class="data"><?= $user['Usuario'] ?></span>
                </div>
                <div style="grid-area: nombre;">
                    <span class="name">Nombre:</span>
                    <span class="data"><?= $user['Nombre'] ?></span>
                </div>

                <div style="grid-area: apellido;">
                    <span class="name">Apellido:</span>
                    <span class="data"><?= $user['Apellido'] ?></span>
                </div>

                <div style="grid-area: permisos;">
                    <span class="name">Permisos:</span>
                    <span class="data"><?= $user['Permisos'] ?></span>
                </div>

                <div style="grid-area: fecha;">
                    <span class="name">Fecha de creacion:</span>
                    <span class="data"><?= $user['FechaCreacion'] ?></span>
                </div>
                <div style="grid-area: boton;">
                    <a href="./editarUsuario.php?ci=<?= $user['CI'] ?>">
                        <button>Editar</button>
                    </a>
                </div>
            </div>
            <!-- </section>
        <section class="tableSection"> -->
            <h2 class="titulo">Eventos</h2>


            <table id="myTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($eventsList as $event) {
                    ?>
                        <tr>
                            <td><?= $event['ID'] ?></td>
                            <td><?= $event['Titulo'] ?></td>
                            <td><?= $event['Descripcion'] ?></td>
                            <td><?= $event['Fecha'] ?></td>
                        </tr>
                    <?php  }
                    ?>
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