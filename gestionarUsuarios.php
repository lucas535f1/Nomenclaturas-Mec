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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="./">Inicio</a>
    <a href="./crearUsuarios.php">Crear Usuarios</a>


    <table>
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
    </table>

</body>

</html>