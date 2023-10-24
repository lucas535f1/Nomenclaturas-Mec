<?php
class EditUser extends db
{

    protected function changePwd($ci, $pwd)
    {
        $query = $this->conn()->prepare("UPDATE `Tecnico` SET `PASS`= :pwd, `PassDefault` = 1 WHERE `CI`= :ci");
        $query->bindParam('ci', $ci);
        $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT);
        $query->bindParam('pwd', $hashedPwd);

        if (!$query->execute()) {
            $msg[0] = "Error SQL 1";
            $msg[1]=false;
            echo json_encode($msg);
            exit();
        }
    }
    protected function updateUser($ci,$ciVieja, $mail, $usuario, $nombre, $apellido, $permisos, $distinto)
    {
        $query = $this->conn()->prepare("SELECT * FROM `Tecnico` WHERE `Mail` = :mail OR `CI`= :ci OR `Usuario`=:usuario");
        $query->bindParam('mail', $mail);
        $query->bindParam('ci', $ci);
        $query->bindParam('usuario', $usuario);

        if (!$query->execute()) {
            $msg[0] = "Error SQL 2";
            $msg[1]=false;
            echo json_encode($msg);
            exit();
        }
        
        if ($query->rowCount() > 1 || ($distinto==true && $query->rowCount() > 0)) {
            $msg[0] = "Ci, mail, y/o usuario ya existentes";
            $msg[1]=false;
            echo json_encode($msg);
            exit();
        }

        $add = $this->conn()->prepare("UPDATE `Tecnico` SET `CI`=:ci,`Mail`=:mail, `Usuario`=:usuario, `Nombre`=:nombre, `Apellido`=:apellido, `Permisos`= :permisos WHERE `CI`=:ciVieja");
        $add->bindParam('ciVieja', $ciVieja);
        $add->bindParam('ci', $ci);
        $add->bindParam('mail', $mail);
        $add->bindParam('usuario', $usuario);
        $add->bindParam('nombre', $nombre);
        $add->bindParam('apellido', $apellido);
        $add->bindParam('permisos', $permisos);

        if (!$add->execute()) {
            $msg[0] = "Error SQL 3";
            $msg[1]=false;
            echo json_encode($msg);
            exit();
        }

        $evento = $this->conn()->prepare("INSERT INTO `Eventos`(`CiUsuario`, `titulo`, `descripcion`) VALUES (:ci,:titulo,:descripcion)");
        session_start();
        $ciUser = $_SESSION['ci'];
        $titulo = "Edicion de usuario";
        $descripcion = "Se edito el usuario " . $usuario;

        $evento->bindParam('ci', $ciUser);
        $evento->bindParam('titulo', $titulo);
        $evento->bindParam('descripcion', $descripcion);
        if (!$evento->execute()) {
            $msg[0] = "Error SQL 4";
            $msg[1]=false;
            echo json_encode($msg);
            exit();
        }
    }
}
