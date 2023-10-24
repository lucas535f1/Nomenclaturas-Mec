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
    <link rel="stylesheet" href="./css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./img/favicon.ico">
    <title>Cambiar contraseña</title>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <div class="container">
        <div class="izquierda">
            <span class="titulo">Cambiar contraseña</span>
            <form id="cambiar">
                <div class="input">
                    <label for="pwd">Nueva constraseña</label>
                    <input type="password" id="pwd" name="pwd">
                </div>
                <div class="input">
                    <label for="pwdRepeat">Repita su constraseña</label>
                    <input type="password" id="pwdRepeat" name="pwdRepeat">
                </div>
                <div class="divBoton">
                    <button type="submit" name="submit" type="button">Cambiar constraseña</button>
                </div>
            </form>
        </div>
        <div class="derecha">
            <span class="nombre">Gestor de Equipos</span>
            <img class="logo" src="./img/LogoMEC.png" alt="Logo mec">
        </div>
    </div>
    <script>
        $("#cambiar").submit(function(e) {
            console.log("cosos")
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "./includes/changePwd.inc.php",
                dataType: "json",
                data: {
                    pwd: document.getElementById("pwd").value,
                    pwdRepeat: document.getElementById("pwdRepeat").value
                },
                success: function(e) {
                    console.log(e)
                    if (e == "success") {
                        window.location = "./"
                    } else {
                        alert(e)
                    }
                }
            });
        });
    </script>
</body>

</html>