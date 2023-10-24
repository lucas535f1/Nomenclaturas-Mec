<?php
session_start();
if (!isset($_SESSION['ci'])) {
    header("Location: ./iniciarsesion.php");
} else if ($_SESSION['permisos'] > 2) {
    header("Location: ./");
} else if (!isset($_GET['id'])) {
    header("Location: ./nomenclaturas.php");
}


include "./classes/Db.classes.php";
include "./classes/Unidad.classes.php";
include "./classes/Unidad-view.classes.php";

$ueView = new UnidadView();
if (!$ueView->UeExists($_GET['id'])) {
    header("Location: ./nomenclaturas.php");
}
$ue = $ueView->fetchUE($_GET['id']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/ue.css">
    <link rel="stylesheet" href="./css/data.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./img/favicon.ico">
    <title>Unidad Ejecutora</title>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <?php
    require "./includes/header.inc.php";
    ?>

    <div class="volver">
        <a href="./nomenclaturas.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
            </svg>
        </a>
    </div>

    <article class="article">
        <section class="dataSection">
            <h2 class="titulo">Unidad ejecutora</h2>
            <div class="dataContainer">
                <div style="grid-area: id;">
                    <span class="name">Numero:</span>
                    <span class="data"><?= $ue['ID'] ?></span>
                </div>
                <div style="grid-area: nombre;">
                    <span class="name">Nombre:</span>
                    <span class="data"><?= $ue['Nombre'] ?></span>
                </div>
                <div style="grid-area: nomenclatura;">
                    <span class="name">Nomenclatura:</span>
                    <span class="data"><?= $ue['Nomenclatura'] ?></span>
                </div>
                <div class="boton baja" style="grid-area: baja;">
                    <a onclick="eliminar()">
                        <button>Eliminar</button>
                    </a>
                </div>
                <div style="grid-area: boton;">
                    <a href="./editarUE.php?id=<?= $ue['ID'] ?>">
                        <button>Editar</button>
                    </a>
                </div>
            </div>
        </section>
    </article>
    <script>
        function eliminar() {
            if (confirm("Se eliminara deifinitivamente ¿Esta seguro?")) {
                $.ajax({
                    type: "post",
                    url: "./includes/ueEliminar.inc.php",
                    dataType: "json",
                    data: {
                        id: <?= $_GET['id'] ?>
                    },
                    success: function(e) {
                        if (e == true) {
                            window.location = "./nomenclaturas.php"
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