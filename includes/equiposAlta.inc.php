<?php

session_start();
if (!isset($_SESSION['ci'])) {
    header("Location: ../iniciarsesion.php");
    //  } else if ($_SESSION['permisos'] < 2) {
    //     header("Location: ../");
} else if (!isset($_GET['id'])) {
    header("Location: ../gestionarEquipos.php");
} else if (!isset($_GET['equipo'])) {
    header("Location: ../equipo.php?id=" . $_GET['id']);
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
$logica->AltaLogica($_GET['id'], $_GET['equipo']);
header("Location: ../equipo.php?id=" . $_GET['id']);
