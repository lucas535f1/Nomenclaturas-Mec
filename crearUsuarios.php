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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/form.css">
    <link rel="stylesheet" href="./css/singup.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./img/favicon.ico">
    <title>Crear Usuario</title>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <?php
    require "./includes/header.inc.php";
    ?>

    <div class="volver">
        <a href="./">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
            </svg>
        </a>
    </div>

    <article class="article">
        <section class="formSection">
            <h2 class="titulo">Crear usuarios</h2>
            <form id="crear">
                <div style="grid-area: ci;">
                    <label for="ci">CI</label>
                    <input type="number" id="ci" name="ci" required autocomplete="off" min="0">
                </div>

                <div style="grid-area: mail;">
                    <label for="mail">Mail</label>
                    <input type="text" id="mail" name="mail" autocomplete="off" required>
                </div>

                <div style="grid-area: usuario;">
                    <label for="usuario">Usuario</label>
                    <input required type="text" id="usuario" name="usuario" autocomplete="off">
                </div>

                <div style="grid-area: pass;">
                    <label for="pwd">Constraseña</label>
                    <input required type="text" id="pwd" name="pwd" value="mec" autocomplete="off">
                </div>

                <div style="grid-area: nombre;">
                    <label for="nombre">Nombre</label>
                    <input required type="text" id="nombre" name="nombre" autocomplete="off">
                </div>

                <div style="grid-area: apellido;">
                    <label for="apellido">Apellido</label>
                    <input required type="text" id="apellido" name="apellido" autocomplete="off">
                </div>

                <div style="grid-area: permisos;">
                    <label for="permisos">Permisos</label>
                    <select required name="permisos" id="permisos">
                        <option value="0">Deshabilitado</option>
                        <option value="1">Usuario</option>
                        <option value="2">Administrador</option>
                    </select>
                </div>

                <div style="grid-area: boton;">
                    <button type="submit" name="submit" type="button">Crear Usuario</button>
                </div>
            </form>
        </section>
    </article>
    <script>
        $("#crear").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "./includes/singup.inc.php",
                dataType: "json",
                data: {
                    ci: document.getElementById("ci").value,
                    mail: document.getElementById("mail").value,
                    usuario: document.getElementById("usuario").value,
                    pwd: document.getElementById("pwd").value,
                    nombre: document.getElementById("nombre").value,
                    apellido: document.getElementById("apellido").value,
                    permisos: document.getElementById("permisos").value
                },
                success: function(e) {
                    if (e == "success") {
                        console.log("crea")
                        window.location = "./usuario.php?ci=" + document.getElementById("ci").value;
                    } else {
                        alert(e)
                    }
                }
            });
        });
    </script>
</body>

</html>