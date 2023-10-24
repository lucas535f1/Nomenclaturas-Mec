<?php
session_start();
if (isset($_SESSION['ci'])) {
    if ($_SESSION['permisos'] == 2) {

        $idViejo = $_POST['idViejo'];
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $nombreViejo = $_POST['nombreViejo'];
        $abreviatura = strtoupper($_POST['abreviatura']);
        $abreviaturaVieja = strtoupper($_POST['abreviaturaVieja']);

        require "../classes/Db.classes.php";
        require "../classes/Unidad.classes.php";
        require "../classes/EditUnidad-contr.classes.php";

        $unidad = new OficinaContr($id,$idViejo,$nombre,$nombreViejo, $abreviatura, $abreviaturaVieja);
        $unidad->editUnidad();

        $msg = true;
        echo json_encode($msg);
    }
}
