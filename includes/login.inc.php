<?php
$usuario = $_POST['usuario'];
$pwd = $_POST['pwd'];

require "../classes/Db.classes.php";
require "../classes/Login.classes.php";
require "../classes/Login-contr.classes.php";
$login = new LoginContr($usuario, $pwd);

$login->login();


if ($_SESSION['pwdDefault']) {
    $msg = "changePwd";
} else {
    $msg = "success";
}
echo json_encode($msg);
