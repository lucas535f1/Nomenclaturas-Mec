<?php
session_start();
if ($_SESSION['pwdDefault'] == true) {
    $ci = $_SESSION['ci'];
    $pwd = $_POST['pwd'];
    $pwdRepeat = $_POST['pwdRepeat'];

    require "../classes/Db.classes.php";
    require "../classes/ChangePwd.classes.php";
    require "../classes/ChangePwd-contr.classes.php";

    $change = new ChangePwdContr($pwd, $pwdRepeat, $ci);

    $change->changePwd();


    $msg = "success";
    echo json_encode($msg);
}
