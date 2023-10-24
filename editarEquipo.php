<?php
session_start();
if (!isset($_SESSION['ci'])) {
    header("Location: ./iniciarsesion.php");
} else if (!isset($_GET['id'])) {
    header("Location: ./gestionarEquipos.php");
}


include "./classes/Db.classes.php";
include "./classes/Equipo.classes.php";
include "./classes/Equipo-view.classes.php";

$equipoView = new EquipoView();

if (!$equipoView->equipoExists($_GET['id'])) {
    header("Location: ./gestionarEquipos.php");
}

$equipo = $equipoView->fetchEquipo($_GET['id']);
$ue = $equipo['ueID'] . "|" . $equipo['ueNomenclatura'];
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/form.css">
    <link rel="stylesheet" href="./css/registrarEquipos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./img/favicon.ico">
    <title>Editar equipo</title>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="./js/editarEquipos.js"></script>
    <?php
    require "./includes/header.inc.php";
    ?>

    <div class="volver">
        <a href="./equipo.php?id=<?=$_GET['id']?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
            </svg>
        </a>
    </div>

    <article class="article">
        <section class="formSection">
            <h2 class="titulo">Editar equipo</h2>
            <form id="registrarEquipos" method="POST" action="./">
                <div style="grid-area: serie;">
                    <label for="serie">Nro Serie*</label>
                    <input required type="text" id="serie" autocomplete="off" value="<?= $equipo['NSerie'] ?>">
                </div>
                <div style="grid-area: inventario;">
                    <label for="idInventario">ID Inventario*</label>
                    <input required type="text" id="idInventario" autocomplete="off" value="<?= $equipo['IdInventario'] ?>">
                </div>

                <div style="grid-area: nombre;">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" autocomplete="off" value="<?= $equipo['Nombre'] ?>">
                </div>
                <div style="grid-area: apellido;">
                    <label for="apellido">Apellido</label>
                    <input type="text" id="apellido" autocomplete="off" value="<?= $equipo['Apellido'] ?>">
                </div>
                <div style="grid-area: usuario;">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario" autocomplete="off" value="<?= $equipo['Usuario'] ?>">
                </div>
                <div style="grid-area: telefono;">
                    <label for="telefono">Telefono</label>
                    <input type="number" id="telefono" autocomplete="off" value="<?= $equipo['Telefono'] ?>">
                </div>

                <div style="grid-area: modelo;">
                    <label for="modelo">Modelo</label>
                    <input type="text" id="modelo" value="<?= $equipo['Modelo'] ?>">
                </div>
                <div style="grid-area: observaciones;">
                    <label for="observaciones">Observaciones</label>
                    <input type="text" id="observaciones" autocomplete="off" value="<?= $equipo['Observaciones'] ?>">
                </div>

                <div style="grid-area: sistema;">
                    <label for="selectSO">Sistema Operativo</label>
                    <aside class="content-select">
                        <select id="selectSO" onchange="so()">
                            <option value="Windows 10" selected>Windows 10</option>
                            <option value="Windows 11">Windows 11</option>
                            <option value="Windows 7">Windows 7</option>
                            <option value="otro">Otro</option>
                        </select>
                        <i></i>
                    </aside>
                </div>
                <div id="soText" style="display: none;">
                    <label for="otrosSO">Sistema Operativo</label>
                    <input type="text" id="otrosSO" oninput="otroSO()" autocomplete="off">
                </div>
                <div style="grid-area: unidad;">
                    <label for="selectUE">Unidad ejecutora</label>
                    <select name="selectUnidades" id="selectUE" onchange="coso()">
                        <option value="" disabled selected hidden>-</option>
                        <?php
                        include "./includes/selectUnidadesReq.inc.php"
                        ?>
                    </select>
                </div>
                <div style="grid-area: oficina;">
                    <label for="selectOficina">Oficina</label>
                    <select oficina="<?= $equipo['oficinaNomenclatura'] ?>" id="selectOficina" onchange="actualizarNombreEquipo()">
                        <?php
                        include "./includes/selectOficinasReq.inc.php"
                        ?>
                    </select>
                </div>
                <div style="grid-area: equipo;">
                    <label for="selectEquipo">Equipo</label>
                    <select equipo="<?= $equipo['TipoEquipo'] ?>" id="selectEquipo" onchange="actualizarNombreEquipo()">
                        <option value="PC" selected>PC</option>
                        <option value="NOT">Notebook</option>
                        <option value="PRT">Impresora</option>
                    </select>
                </div>
                <div style="grid-area: nombreEquipo;">
                    <label>Nombre equipo</label>
                    <input type="text" id="nombreEquipo" autocomplete="off" nombre="<?= $equipo['NombrePC'] ?>" value="<?= $equipo['NombrePC'] ?>">
                </div>

                <div class="divBoton" class="button" style="grid-area: boton;">
                    <button type="submit" name="submit">Guardar</button>
                </div>
            </form>
        </section>
    </article>
    <script>
        $("#registrarEquipos").submit(function(e) {
            e.preventDefault();
            var selectOficina = document.getElementById("selectOficina");
            var idOficina = selectOficina.options[selectOficina.selectedIndex].getAttribute("idoficina");
            $.ajax({
                type: "post",
                url: "./includes/editEquipo.inc.php",
                //dataType: "json",
                data: {
                    id: <?= $equipo['ID'] ?>,
                    nombreViejo: '<?= $equipo['NombrePC'] ?>',
                    serie: document.getElementById("serie").value,
                    telefono: document.getElementById("telefono").value,
                    nombre: document.getElementById("nombre").value,
                    apellido: document.getElementById("apellido").value,
                    usuario: document.getElementById("usuario").value,
                    modelo: document.getElementById("modelo").value,
                    observaciones: document.getElementById("observaciones").value,
                    idInventario: document.getElementById("idInventario").value,
                    so: document.getElementById("selectSO").value,
                    oficina: idOficina,
                    tipoEquipo: document.getElementById("selectEquipo").value,
                    equipo: document.getElementById("nombreEquipo").value
                },
                success: function(e) {
                    if (e = true) {
                        window.location = "./equipo.php?id=<?= $equipo['ID'] ?>"
                    } else {
                        alert(e)
                    }
                }
            });
        });
    </script>
</body>

</html>