<?php

session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: ./iniciarsesion.php");
}
header('Content-Type: text/html; charset=UTF-8');

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar equipos</title>
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/registrarEquipos.css">
    <link rel="stylesheet" href="./css/form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./img/favicon.ico">
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="./js/registrarEquipos.js"></script>
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
            <h2 class="titulo">Registrar equipos</h2>
            <form id="registrarEquipos" method="POST" action="./">
                <div style="grid-area: serie;">
                    <label for="serie">Nro Serie*</label>
                    <input required type="text" id="serie" autocomplete="off">
                </div>
                <div style="grid-area: inventario;">
                    <label for="idInventario">ID Inventario*</label>
                    <input required type="text" id="idInventario" autocomplete="off">
                </div>

                <div style="grid-area: nombre;">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" autocomplete="off">
                </div>
                <div style="grid-area: apellido;">
                    <label for="apellido">Apellido</label>
                    <input type="text" id="apellido" autocomplete="off">
                </div>
                <div style="grid-area: usuario;">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario" autocomplete="off">
                </div>
                <div style="grid-area: telefono;">
                    <label for="telefono">Telefono</label>
                    <input type="number" id="telefono" autocomplete="off" min="0">
                </div>

                <div style="grid-area: modelo;">
                    <label for="modelo">Modelo</label>
                    <input type="text" id="modelo">
                </div>
                <div style="grid-area: observaciones;">
                    <label for="observaciones">Observaciones</label>
                    <input type="text" id="observaciones" autocomplete="off">
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
                    <label for="selectUE">Unidad ejecutora*</label>
                    <aside class="content-select">
                        <select name="selectUnidades" required id="selectUE" onchange="coso()">
                            <option value="" disabled selected hidden>-</option>
                            <?php
                            include "./includes/selectUnidadesReq.inc.php"
                            ?>
                        </select>
                        <i></i>
                    </aside>
                </div>
                <div style="grid-area: oficina;">
                    <label for="selectOficina">Oficina*</label>
                    <aside class="content-select">
                        <select id="selectOficina" required onchange="actualizarNombreEquipo()">
                            <option value="x">-</option>
                        </select>
                        <i></i>
                    </aside>
                </div>

                <div style="grid-area: equipo;">
                    <label for="selectEquipo">Equipo</label>
                    <aside class="content-select">
                        <select id="selectEquipo" onchange="actualizarNombreEquipo()">
                            <option value="PC" selected>PC</option>
                            <option value="NOT">Notebook</option>
                            <option value="IMP">Impresora</option>
                        </select>
                        <i></i>
                    </aside>
                </div>

                <div style="grid-area: nombreEquipo;">
                    <label for="nombreEquipo">Nombre equipo</label>
                    <input type="text" id="nombreEquipo" autocomplete="off">
                </div>

                <div class="divBoton" class="button" style="grid-area: boton;">
                    <button type="submit" name="submit">Agregar</button>
                </div>
            </form>
        </section>
    </article>
    <script>
        $("#registrarEquipos").submit(function(e) {
            e.preventDefault();
            if (document.getElementById("nombreEquipo").value != '') {
                var selectOficina = document.getElementById("selectOficina");
                var idOficina = selectOficina.options[selectOficina.selectedIndex].getAttribute("idoficina");
                $.ajax({
                    type: "post",
                    url: "./includes/registrarEquipo.inc.php",
                    dataType: "json",
                    data: {
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
                        alert(e)
                        console.log("entra")
                        if (e == "Equipo registrado correctamente") {
                            document.getElementById("registrarEquipos").reset()
                            $('#selectOficina').html("<option value='x'>-</option>");
                            $('#nombreEquipo').html("");
                            document.getElementById("soText").setAttribute("style", "display: none;");
                        }

                    }
                });

            } else {
                alert("Debe seleccionar el destino del equipo")
            }
        });

        getNombreEquipo(function(response) {
            return response;
        })
    </script>
</body>

</html>