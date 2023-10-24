<?php
$ci = $_POST['ci'];
$ciVieja = $_POST['ciVieja'];
$mail = $_POST['mail'];
$mailViejo = $_POST['mailViejo'];
$usuario = $_POST['usuario'];
$userViejo = $_POST['userViejo'];
$pwd = $_POST['pwd'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$permisos = $_POST['permisos'];

require "../classes/Db.classes.php";
require "../classes/EditUser.classes.php";
require "../classes/EditUser-contr.classes.php";

$edit = new EditUserContr($ci,$ciVieja, $mail,$mailViejo, $usuario,$userViejo, $pwd, $nombre, $apellido, $permisos);
$edit->EditUser();

$msg[0]="Se edito el usuario correctamente";
$msg[1]=true;
echo json_encode($msg);
