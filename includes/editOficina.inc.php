<?php
session_start();
if (isset($_SESSION['ci'])) {
    if ($_SESSION['permisos'] == 2) {

        $id = $_POST['id'];
        $ue = $_POST['ue'];
        $nombre = $_POST['nombre'];
        $nombreViejo = $_POST['nombreViejo'];
        $abreviatura = strtoupper($_POST['abreviatura']);
        $abreviaturaVieja = strtoupper($_POST['abreviaturaVieja']);

        require "../classes/Db.classes.php";
        require "../classes/Oficina.classes.php";
        require "../classes/EditOficina-contr.classes.php";

        $unidad = new OficinaContr($id,$ue,$nombre,$nombreViejo, $abreviatura, $abreviaturaVieja);
        $unidad->editOficina();

        $msg = true;
        echo json_encode($msg);
    }
}
