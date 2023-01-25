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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario <?= $user['Nombre'] ?> <?= $user['Apellido'] ?></title>
</head>

<body>
    <a href="./">Inicio</a>
    <a href="./gestionarUsuarios.php">Usuarios</a>
    <p>Ci: <?= $user['CI'] ?><br>Mail: <?= $user['Mail'] ?><br>Usuario: <?= $user['Usuario'] ?><br>nombre: <?= $user['Nombre'] ?><br>apellido: <?= $user['Apellido'] ?><br>permisos: <?= $user['Permisos'] ?><br>Fecha de creacion: <?= $user['FechaCreacion'] ?></p>
    <table>
        <tr>
            <th>id</th>
            <th>titulo</th>
            <th>descripcion</th>
            <th>Fecha</th>
        </tr>
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
    </table>
</body>

</html>