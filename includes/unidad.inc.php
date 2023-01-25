<?php
session_start();
if (isset($_SESSION['ci'])) {
    if ($_SESSION['permisos'] == 2) {

        $numero = $_POST['numero'];
        $nombre = $_POST['nombre'];
        $abreviatura = strtoupper($_POST['abreviatura']);

        require "../classes/Db.classes.php";
        require "../classes/Unidad.classes.php";
        require "../classes/Unidad-contr.classes.php";

        $unidad = new UnidadContr($numero,$nombre, $abreviatura);
        $unidad->createUnidad();

        $msg = "Se agrego correctamente";
        echo json_encode($msg);
    }
}
