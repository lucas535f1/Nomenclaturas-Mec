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
include "./classes/Oficina.classes.php";
include "./classes/Oficina-view.classes.php";

$oficinaView = new OficinaView();
if (!$oficinaView->oficinaExists($_GET['id'])) {
    header("Location: ./nomenclaturas.php");
}
$oficina = $oficinaView->fetchOficina($_GET['id']);
$ue = $oficina['IdUE'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/form.css">
    <link rel="stylesheet" href="./css/editArea.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./img/favicon.ico">
    <title>Editar Area</title>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <?php
    require "./includes/header.inc.php";
    ?>

    <div class="volver">
        <a href="./area.php?id=<?=$_GET['id']?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
            </svg>
        </a>
    </div>

    <article class="article">
        <section class="formSection">
            <h2 class="titulo">Editar Oficina <?=substr($_SERVER['REQUEST_URI'],0,19)?></h2>
            <form id="editar" action="./">
                <div style="grid-area: numero;">
                    <label for="selectUE">Unidad ejecutora</label>
                    <select required autocomplete="off" name="selectUnidades" id="selectUE">
                        <option value="" disabled selected hidden>-</option>
                        <?php
                        include "./includes/selectUnidadesReq.inc.php"
                        ?>
                    </select>
                </div>
                <div style="grid-area: nombre;">
                    <label for="nombreOficina">Nombre</label>
                    <input required autocomplete="off" type="text" id="nombreOficina" value="<?= $oficina['Nombre'] ?>">
                </div>
                <div style="grid-area: abreviatura;">
                    <label for="abreviaturaOficina">Abreviatura</label>
                    <input required autocomplete="off" type="text" id="abreviaturaOficina" value="<?= $oficina['Nomenclatura'] ?>">
                </div>
                <div style="grid-area: boton;">
                    <button type="submit" name="submit" type="button">Guardar</button>
                </div>
            </form>
        </section>
    </article>

    <script>
        $("#editar").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "./includes/editOficina.inc.php",
                dataType: "json",
                data: {
                    id: <?= $_GET['id'] ?>,
                    ue: document.getElementById("selectUE").value,
                    nombre: $("#nombreOficina").val(),
                    nombreViejo: '<?= $oficina['Nombre'] ?>',
                    abreviatura: $("#abreviaturaOficina ").val(),
                    abreviaturaVieja: '<?= $oficina['Nomenclatura'] ?>'
                },
                success: function(e) {
                    if (e == true) {
                        window.location = "./area.php?id=<?= $_GET['id'] ?>";
                    } else {
                        alert(e)
                    }

                }
            });
        });
    </script>
</body>

</html>