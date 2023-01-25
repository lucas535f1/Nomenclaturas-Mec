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
            header("location:../crearUsuarios.php?noejecuta");
            exit();
        }

        if ($query->rowCount() > 0) {
            header("location:../crearUsuarios.php?yaExiste");
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
            header("location:../crearUsuarios.php?noejecuta");
            exit();
        }

        $evento = $this->conn()->prepare("INSERT INTO `Eventos`(`CiUsuario`, `titulo`, `descripcion`) VALUES (:ci,:titulo,:descripcion)");
        session_start();
        $ciUser = $_SESSION['ci'];
        $titulo = "Creacion de usuario";
        $descripcion = "Se creo el usuario " . $usuario;

        $evento->bindParam('ci', $ciUser);
        $evento->bindParam('titulo', $titulo);
        $evento->bindParam('descripcion', $descripcion);
        if (!$evento->execute()) {
            header("location:../crearUsuarios.php?noejecuta");
            exit();
        }
    }
}
