<?php
session_start();
if (isset($_SESSION['nombre'])) {
    header("Location: ./");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

<body>
    <section>
        <h2>Iniciar Sesion</h2>
        <form action="./includes/login.inc.php" method="POST">
            <div>
                <label for="usuario">Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" >
            </div>
            <div>
                <label for="pwd">Constraseña</label>
                <input type="password" id="pwd" name="pwd" >
            </div>
            <div>
                <button type="submit" name="submit" type="button">Iniciar Sesion</button>
            </div>
        </form>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
</body>

</html>