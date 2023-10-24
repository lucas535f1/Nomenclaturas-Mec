<?php
class Singup extends db
{

    protected function singupUser($ci, $mail, $usuario, $pwd, $nombre, $apellido, $permisos)
    {


        $query = $this->conn()->prepare("SELECT * FROM `Tecnico` WHERE `Mail` = :mail OR `CI`= :ci OR `Usuario`=:usuario");
        $query->bindParam('mail', $mail);
        $query->bindParam('ci', $ci);
        $query->bindParam('usuario', $usuario);

        if (!$query->execute()) {
            $msg="Error SQL 1";
            echo json_encode($msg);
            exit();
        }

        if ($query->rowCount() > 0) {
            $msg="Mail, CI y/o Usuario repetidos";
            echo json_encode($msg);
            exit();
        }

        $add = $this->conn()->prepare("INSERT INTO `Tecnico`(`CI`,`Mail`, `Usuario`, `Nombre`, `Apellido`, `Pass`, `Permisos`) VALUES (:ci,:mail,:usuario,:nombre,:apellido,:pwd,:permisos)");
        $add->bindParam('ci', $ci);
        $add->bindParam('mail', $mail);
        $add->bindParam('usuario', $usuario);
        $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT);
        $add->bindParam('pwd', $hashedPwd);
        $add->bindParam('nombre', $nombre);
        $add->bindParam('apellido', $apellido);
        $add->bindParam('permisos', $permisos);

        if (!$add->execute()) {
            $msg="Error SQL 2";
            echo json_encode($msg);
            exit();
        }

        $evento = $this->conn()->prepare("INSERT INTO `Eventos`(`CiUsuario`, `titulo`, `descripcion`) VALUES (:ci,:titulo,:descripcion)");
        $ciUser = $_SESSION['ci'];
        $titulo = "Creacion de usuario";
        $descripcion = "Se creo el usuario " . $usuario;

        $evento->bindParam('ci', $ciUser);
        $evento->bindParam('titulo', $titulo);
        $evento->bindParam('descripcion', $descripcion);
        if (!$evento->execute()) {
            $msg="Error SQL 3";
            echo json_encode($msg);
            exit();
        }
    }

}
