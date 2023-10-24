<?php
session_start();
if (!isset($_SESSION['ci'])) {
    header("Location: ../iniciarsesion.php");
} else if (!isset($_GET['id'])) {
    header("Location: ../gestionarEquipos.php");
}

require "../classes/Db.classes.php";
require "../classes/Equipo.classes.php";
require "../classes/Equipo-view.classes.php";
require "../classes/EquipoLogica.classes.php";
require "../classes/EquipoLogica-contr.classes.php";

$equipoView = new EquipoView();

if (!$equipoView->equipoExists($_POST['id'])) {
    header("Location: ../gestionarEquipos.php");
}

$logica = new EquipoLogicaContr();
$logica->eliminar($_POST['id']);
echo json_encode(true);
