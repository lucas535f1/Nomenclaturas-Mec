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

$usersView = new UsersView();

if (!$usersView->userExists($_GET['ci'])) {
    header("Location: ./gestionarUsuarios.php");
}

$user = $usersView->fetchUser($_GET['ci']);
$permisos0 = "";
$permisos1 = "";
$permisos2 = "";
switch ($user['Permisos']) {
    case 0:
        $permisos0 = "selected";
        break;
    case 1:
        $permisos1 = "selected";
        break;
    case 2:
        $permisos2 = "selected";
        break;
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
    <link rel="stylesheet" href="./css/editUser.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./img/favicon.ico">
    <title>Editar Usuario</title>
</head>

<body>
    <?php
    require "./includes/header.inc.php";
    ?>

    <div class="volver">
        <a href="./usuario.php?ci=<?= $_GET['ci'] ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
            </svg>
        </a>
    </div>

    <article class="article">
        <section class="formSection">
            <h2 class="titulo">Editar Usuarios</h2>
            <form id="editar">
                <div style="grid-area: ci;">
                    <label for="ci">Ci</label>
                    <input required autocomplete="off" min="0" type="text" id="ci" name="ci" value="<?= $user['CI'] ?>">
                </div>
                <div style="grid-area: mail;">
                    <label for="mail">Mail</label>
                    <input required autocomplete="off" type="text" id="mail" name="mail" value="<?= $user['Mail'] ?>">
                </div>
                <div style="grid-area: usuario;">
                    <label for="usuario">Usuario</label>
                    <input required autocomplete="off" type="text" id="usuario" name="usuario" value="<?= $user['Usuario'] ?>">
                </div>
                <div style="grid-area: permisos;">
                    <label for="permisos">Permisos</label>
                    <select name="permisos" id="permisos">
                        <option value="0" <?= $permisos0 ?>>Deshabilitado</option>
                        <option value="1" <?= $permisos1 ?>>Usuario</option>
                        <option value="2" <?= $permisos2 ?>>Administrador</option>
                    </select>
                </div>
                <div style="grid-area: nombre;">
                    <label onclick="pwd()" for="nombre">Nombre</label>
                    <input required autocomplete="off" type="text" id="nombre" name="nombre" value="<?= $user['Nombre'] ?>">
                </div>
                <div style="grid-area: apellido;">
                    <label for="apellido">Apellido</label>
                    <input required autocomplete="off" type="text" id="apellido" name="apellido" value="<?= $user['Apellido'] ?>">
                </div>
                <div style="grid-area: check;">
                    <label for="cambiar">Cambiar contraseña</label>
                    <input type="checkbox" id="cambiar" value="cambiar" onchange="contrasena()">
                    <label for="cambiar" class="checkbox" onclick="pwd()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                        </svg>
                    </label>
                </div>
                <div id="pwdInput" style="display:none">
                    <label for="pwd">Constraseña</label>
                    <input autocomplete="off" type="text" id="pwd" name="pwd">
                </div>
                <div style="grid-area: boton;">
                    <button type="submit" name="submit">Guardar</button>
                </div>
            </form>
        </section>
    </article>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="./js/editarUsuarios.js"></script>
    <script>
        $("#editar").submit(function(e) {
            console.log(1)
            e.preventDefault();
            console.log(2)
            $.ajax({
                type: "post",
                url: "./includes/editUser.inc.php",
                dataType: "json",
                data: {
                    ci: $("#ci").val(),
                    ciVieja: <?= $_GET['ci'] ?>,
                    mailViejo: "<?= $user['Mail'] ?>",
                    userViejo: "<?= $user['Usuario'] ?>",
                    mail: $("#mail").val(),
                    usuario: $("#usuario").val(),
                    pwd: $("#pwd").val(),
                    nombre: $("#nombre").val(),
                    apellido: $("#apellido").val(),
                    permisos: $("#permisos").val(),
                },
                success: function(e) {
                    console.log(e)
                    if (e[1]) {
                        window.location = "../usuario.php?ci=" + $("#ci").val();
                    } else {
                        alert(e[0])
                    }
                }
            });
        });
    </script>
</body>

</html>