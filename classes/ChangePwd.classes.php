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
            $msg="Error SQL";
            echo json_encode($msg);
            exit();
        }

        $_SESSION['pwdDefault'] = false;
    }
}
