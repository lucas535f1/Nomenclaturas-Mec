<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: ./iniciarsesion.php");
}
if ($_SESSION['permisos'] != 2) {
    header("Location: ./");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta</title>
</head>

<body>
    <a href="./">Inicio</a>

    <h2>Crear usuarios</h2>
    <form action="./includes/singup.inc.php" method="POST">
        <div>
            <label for="ci">CI</label>
            <input type="text" id="ci" name="ci">
        </div>
        <div>
            <label for="mail">Mail</label>
            <input type="text"  id="mail" name="mail">
        </div>
        <div>
            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" name="usuario">
        </div>
        <div>
            <label for="pwd">Constraseña</label>
            <input type="text" id="pwd" name="pwd" value="mec">
        </div>
        <div>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre">
        </div>
        <div>
            <label for="apellido">Apellido</label>
            <input type="text" id="apellido" name="apellido">
        </div>
        <div>
            <label for="permisos">Permisos</label>
            <select name="permisos" id="permisos">
                <option value="0">Deshabilitado</option>
                <option value="1">Usuario</option>
                <option value="2">Administrador</option>
            </select>
        </div>
        <div>
            <button type="submit" name="submit" type="button">Crear Usuario</button>
        </div>
    </form>
</body>

</html>