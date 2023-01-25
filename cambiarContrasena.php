<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: ./iniciarsesion.html");
}
if (!$_SESSION['pwdDefault']) {
    header("Location: ./");
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar contraseña</title>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

<body>
    <section>
        <h2>Cambiar contraseña</h2>
        <form action="./includes/changePwd.inc.php" method="POST">
            <div>
                <label for="pwd">Constraseña</label>
                <input type="password" id="pwd" name="pwd">
            </div>
            <div>
                <label for="pwdRepeat">Repita su constraseña</label>
                <input type="password" id="pwdRepeat" name="pwdRepeat">
            </div>
            <div>
                <button type="submit" name="submit" type="button">Cambiar constraseña</button>
            </div>
        </form>
    </section>
</body>

</html>