<?php

if(isset($_POST['submit'])){
    session_start();
    $ci=$_SESSION['ci'];
    $pwd=$_POST['pwd'];
    $pwdRepeat=$_POST['pwdRepeat'];

    require "../classes/Db.classes.php";
    require "../classes/ChangePwd.classes.php";
    require "../classes/ChangePwd-contr.classes.php";

    $change = new ChangePwdContr($pwd,$pwdRepeat,$ci);

    $change->changePwd();

    
    header("location:../");

}