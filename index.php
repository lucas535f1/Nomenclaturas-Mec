<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: ./iniciarsesion.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>

<body>
    <h5>sistema nomenclaturas </h5>
    
    <?php if ($_SESSION['permisos'] == 2) {
    ?>
        <a href="./gestionarUsuarios.php">Usuarios</a>
        <a href="./eventos.php">Visor de eventos</a>
        <a href="./nomenclaturas.php">Nomenclaturas</a>
    <?php } ?>

    <a href="./includes/closeSession.inc.php">Cerrar Sesion</a>
</body>

</html>