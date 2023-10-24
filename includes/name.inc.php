<?php
require_once "../classes/Db.classes.php";
require_once "../classes/Name.classes.php";
require_once "../classes/Name-view.classes.php";

$ue = str_replace("\"","",$_POST['ue']);
$oficina = $_POST['oficina'];
$equipo = $_POST['equipo'];
$nombre = $ue . "-" . $equipo . "-" . $oficina . "-%";

$nameView = new NameView();
$name =$nameView->fetchNumber($nombre);
echo $name;

