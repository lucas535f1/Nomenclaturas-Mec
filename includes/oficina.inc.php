<?php

session_start();
if (isset($_SESSION['ci'])) {
    if ($_SESSION['permisos'] == 2) {

        $numero = $_POST['numero'];
        $nombre = $_POST['nombre'];
        $abreviatura = strtoupper($_POST['abreviatura']);

        require "../classes/Db.classes.php";
        require "../classes/Oficina.classes.php";
        require "../classes/Oficina-contr.classes.php";

        $unidad = new OficinaContr($numero,$nombre, $abreviatura);
        $unidad->createOficina();

        $msg = "Se agrego correctamente";
        echo json_encode($msg);
    }
}
