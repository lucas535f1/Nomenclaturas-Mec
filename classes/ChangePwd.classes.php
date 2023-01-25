<?php

class ChangePwd extends Db
{

    protected function change($pwd, $ci)
    {
        $query = $this->conn()->prepare("UPDATE `Tecnico` SET `Pass` = :pwd , `PassDefault` = 0 WHERE `ci` = :ci");
        $query->bindParam('ci', $ci);
        $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT);
        $query->bindParam('pwd', $hashedPwd);

        if (!$query->execute()) {
            header("location:../cambiarContrasena.php?noejecuta");
            exit();
        }
        session_start();
        $_SESSION['pwdDefault'] = false;
    }
}
