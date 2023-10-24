<?php
session_start();
if($_SESSION['permisos']==2){

    $ci=$_POST['ci'];
    $mail=$_POST['mail'];
    $usuario=$_POST['usuario'];
    $pwd=$_POST['pwd'];
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $permisos=$_POST['permisos'];
    
    require "../classes/Db.classes.php";
    require "../classes/Singup.classes.php";
    require "../classes/Singup-contr.classes.php";

    $singup = new SingupContr($ci,$mail,$usuario,$pwd,$nombre,$apellido,$permisos);
    $singup->createUser();

    $msg="success";
    echo json_encode($msg);
}