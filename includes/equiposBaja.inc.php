<?php

session_start();
if (!isset($_SESSION['ci'])) {
    header("Location: ../iniciarsesion.php");
//  } else if ($_SESSION['permisos'] < 2) {
//     header("Location: ../");
} else if (!isset($_GET['id'])) {
    header("Location: ../gestionarEquipos.php");
}

require "../classes/Db.classes.php";
require "../classes/Equipo.classes.php";
require "../classes/Equipo-view.classes.php";
require "../classes/EquipoLogica.classes.php";
require "../classes/EquipoLogica-contr.classes.php";

$equipoView = new EquipoView();

if (!$equipoView->equipoExists($_GET['id'])) {
    header("Location: ../gestionarEquipos.php");
}

$logica = new EquipoLogicaContr();
$logica->bajaLogica($_GET['id']);
header("Location: ../equipo.php?id=".$_GET['id']);
