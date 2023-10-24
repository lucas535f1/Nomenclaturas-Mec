<?php
class Users extends Db
{

    protected function getAllUsers()
    {
        $query = $this->conn()->prepare("SELECT `CI` AS ci,`Mail` AS mail,`Usuario` AS user,`Nombre` AS nombre,`Apellido` AS apellido,`Permisos` AS permisos,`FechaCreacion` as FechaCreacion FROM `Tecnico`");

        if (!$query->execute()) {
            header("location:../?noejecuta");
            exit();
        }

        $users = $query->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }

    protected function getUser($ci)
    {
        $query = $this->conn()->prepare("SELECT `CI`,`Mail`,`Usuario`,`Nombre`,`Apellido`,`Permisos`,`FechaCreacion` FROM `Tecnico` WHERE `CI` = :ci");
        $query->bindParam('ci', $ci);

        if (!$query->execute()) {
            header("location:../usuario.php?id=" . $ci . "&noejecuta");
            exit();
        }

        $user = $query->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    protected function existsUser($ci)
    {
        $query = $this->conn()->prepare("SELECT `ci` FROM `Tecnico` WHERE `CI` = :ci");
        $query->bindParam('ci', $ci);

        if (!$query->execute()) {
            header("location:../gestionarUsuarios.php?noejecuta");
            exit();
        }
        $result = true;
        if ($query->rowCount() == 0) {
            $result = false;
        }
        return $result;
    }
}
