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
    <link rel="stylesheet" href="./css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./img/favicon.ico">
    <title>Iniciar Sesión</title>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="izquierda">
            <span class="titulo">Iniciar Sesión</span>
            <form id="iniciar">
                <div class="input">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario" name="usuario" required min="1" placeholder=" Ingrese su Usuario">
                </div>
                <div class="input">
                    <label for="pwd">Constraseña</label>
                    <input type="password" id="pwd" name="pwd" required min="1" placeholder=" Ingrese su Contraseña">
                </div>
                <div class="divBoton">
                    <button type="submit" name="submit" type="button">Iniciar Sesion</button>
                </div>
            </form>
        </div>
        <div class="derecha">
            <span class="nombre">Gestor de Equipos</span>
            <img class="logo" src="./img/LogoMEC.png" alt="Logo mec">
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script>
        $("#iniciar").submit(function(e) {
            console.log("cosos")
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "./includes/login.inc.php",
                dataType: "json",
                data: {
                    pwd: document.getElementById("pwd").value,
                    usuario: document.getElementById("usuario").value
                },
                success: function(e) {
                    console.log(e)
                    if (e == "success") {
                        window.location = "./"
                    } else if (e == "changePwd") {
                        window.location = "./cambiarContrasena.php"
                    } else {
                        alert(e)
                    }
                }
            });
        });
    </script>
</body>

</html>