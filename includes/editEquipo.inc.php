<?php
$id = $_POST['id'];
$nombreViejo = $_POST['nombreViejo'];
$serie = $_POST['serie'];
$telefono = $_POST['telefono'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$usuario = $_POST['usuario'];
$modelo = $_POST['modelo'];
$observaciones = $_POST['observaciones'];
$idInventario = $_POST['idInventario'];
$so = $_POST['so'];
$oficina = $_POST['oficina'];
$tipoEquipo = $_POST['tipoEquipo'];
$nombreEquipo = $_POST['equipo'];

require "../classes/Db.classes.php";
require "../classes/EditEquipo.classes.php";
require "../classes/EditEquipo-contr.classes.php";


$equipo = new EditEquipoContr($id, $nombreViejo, $serie, $telefono, $nombre, $apellido, $usuario, $modelo, $observaciones, $idInventario, $so, $oficina, $tipoEquipo, $nombreEquipo);
$equipo->editEquipo();

$msg=true;
echo json_encode($msg);
