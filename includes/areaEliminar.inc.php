<?php
session_start();
if (!isset($_SESSION['ci'])) {
    header("Location: ../iniciarsesion.php");
} else if (!isset($_POST['id'])) {
    header("Location: ../gestionarEquipos.php");
}

require "../classes/Db.classes.php";
require "../classes/Oficina.classes.php";
require "../classes/Oficina-view.classes.php";
require "../classes/removeUEO.classes.php";
require "../classes/removeUEO-contr.classes.php";

$oficinaView = new OficinaView();

if (!$oficinaView->oficinaExists($_POST['id'])) {
    header("Location: ../gestionarEquipos.php");
}

$eliminar = new removeUEOContr();
$eliminar->deleteO($_POST['id']);
$msg=true;
echo json_encode($msg);
exit();
