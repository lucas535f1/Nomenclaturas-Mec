<?php

if(isset($_POST['submit'])){

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

    header("location:../crearUsuarios.php");

}