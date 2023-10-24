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

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/equipo.css">
    <link rel="stylesheet" href="./css/data.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./img/favicon.ico">
    <title>Equipo</title>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <?php
    require "./includes/header.inc.php";
    ?>

    <?php if ($equipo['bajaLogica'] == 0) { ?>
        <div class="volver">
            <a href="./gestionarEquipos.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                    <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
                </svg>
            </a>
        </div>
    <?php } else { ?>
        <div class="volver">
            <a href="./equiposBaja.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                    <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
                </svg>
            </a>
        </div>
    <?php } ?>

    <article class="article">
        <section class="dataSection">
            <h2 class="titulo">Equipo</h2>
            <div class="dataContainer">
                <div style="grid-area: id;">
                    <span class="name">id:</span>
                    <span class="data"><?= $equipo['ID'] ?></span>
                </div>
                <div style="grid-area: serie;">
                    <span class="name">Nro de serie:</span>
                    <span class="data"><?= $equipo['NSerie'] ?></span>
                </div>
                <div style="grid-area: telefono;">
                    <span class="name">Telefono:</span>
                    <span class="data"><?= $equipo['Telefono'] ?></span>
                </div>
                <div style="grid-area: nombre;">
                    <span class="name">Nombre:</span>
                    <span class="data"><?= $equipo['Nombre'] ?></span>
                </div>
                <div style="grid-area: apellido;">
                    <span class="name">Apellido:</span>
                    <span class="data"><?= $equipo['Apellido'] ?></span>
                </div>
                <div style="grid-area: usuario;">
                    <span class="name">Usuario:</span>
                    <span class="data"><?= $equipo['Usuario'] ?></span>
                </div>
                <div style="grid-area: nombrePC;">
                    <span class="name">Nombre PC:</span>
                    <span class="data"><?= $equipo['NombrePC'] ?></span>
                </div>
                <div style="grid-area: fecha;">
                    <span class="name">Fecha:</span>
                    <span class="data"><?= $equipo['Fecha'] ?></span>
                </div>
                <div style="grid-area: inventario;">
                    <span class="name">Id Inventario:</span>
                    <span class="data"><?= $equipo['IdInventario'] ?></span>
                </div>
                <div style="grid-area: sistema;">
                    <span class="name">Sistema Operativo:</span>
                    <span class="data"><?= $equipo['SistemaOp'] ?></span>
                </div>
                <div style="grid-area: tipo;">
                    <span class="name">Tipo:</span>
                    <span class="data"><?= $equipo['TipoEquipo'] ?></span>
                </div>
                <div style="grid-area: modelo;">
                    <span class="name">Modelo:</span>
                    <span class="data"><?= $equipo['Modelo'] ?></span>
                </div>
                <div style="grid-area: ue;">
                    <span class="name">Unidad ejecutora:</span>
                    <span class="data"><?= $equipo['ue'] ?></span>
                </div>
                <div style="grid-area: oficina;">
                    <span class="name">Oficina:</span>
                    <span class="data"><?= $equipo['oficina'] ?></span>
                </div>
                <div style="grid-area: tecnico;">
                    <span class="name">Tecnico:</span>
                    <span class="data"><?= $equipo['nombreTecnico'] ?></span>
                </div>
                <div style="grid-area: observaciones;">
                    <span class="name">Observaciones:</span>
                    <span class="data"><?= $equipo['Observaciones'] ?></span>
                </div>
                <?php if (/*$_SESSION['permisos'] == 2 && */$equipo['bajaLogica'] == 0) { ?>
                    <div class="boton baja" style="grid-area: baja;">
                        <a href="./includes/equiposBaja.inc.php?id=<?= $equipo['ID'] ?>">
                            <button>Dar de baja</button>
                        </a>
                    </div>
                <?php } else { ?>
                    <div class="boton baja" style="grid-area: baja;">
                        <a onclick="eliminar()">
                            <button>Eliminar</button>
                        </a>
                    </div>
                <?php
                }
                if ($equipo['bajaLogica'] == 0) { ?>
                    <div class="boton" style="grid-area: boton;">
                        <a href="./editarEquipo.php?id=<?= $equipo['ID'] ?>">
                            <button>Editar</button>
                        </a>
                    </div>
                <?php }
                if ($equipo['bajaLogica'] == 1) { ?>
                    <div class="boton" style="grid-area: boton;">
                        <a href="./includes/equiposAlta.inc.php?id=<?= $equipo['ID'] ?>&&equipo=<?= $equipo['NombrePC'] ?>">
                            <button>Dar de alta</button>
                        </a>
                    </div>
                <?php } ?>
        </section>
    </article>

    <script>
        function eliminar() {
            if (confirm("Se eliminara deifinitivamente ¿Esta seguro?")) {
                $.ajax({
                    type: "post",
                    url: "./includes/equiposEliminar.inc.php",
                    //dataType: "json",
                    data: {
                        id: <?= $_GET['id'] ?>
                    },
                    success: function(e) {
                        console.log(e)
                        if (e) {
                            window.location = "./equiposBaja.php"
                        } else {
                            alert(e)
                        }
                    }
                });

            }
        }
    </script>
</body>

</html>