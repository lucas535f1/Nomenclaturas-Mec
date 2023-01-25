<?php

session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: ./iniciarsesion.php");
}
if ($_SESSION['permisos'] != 2) {
    header("Location: ./");
}


include "./classes/Db.classes.php";
include "./classes/Events.classes.php";
include "./classes/Events-view.classes.php";

$eventsView = new EventsView();
$eventsList = $eventsView->fetchAllEvents();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visor de eventos</title>
</head>

<body>
    <a href="./">Inicio</a>
    <table>
        <tr>
            <th>id</th>
            <th>Usuario</th>
            <th>Titulo</th>
            <th>Descripcion</th>
            <th>Fecha</th>
        </tr>
        <?php
        foreach ($eventsList as $event) {
        ?>
            <tr>
                <td><?= $event['ID'] ?></td>
                <td><a href="./usuario.php?id=<?= $event['CiUsuario'] ?>"><?= $event['Usuario'] ?></a></td>
                <td><?= $event['Titulo'] ?></td>
                <td><?= $event['Descripcion'] ?></td>
                <td><?= $event['Fecha'] ?></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>