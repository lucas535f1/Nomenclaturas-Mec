<?php
class Oficina extends Db
{

    protected function setOficina($numero, $nombre, $abreviatura)
    {
        $query = $this->conn()->prepare("INSERT INTO `Area` (`IdUE`, `Nombre`, `Nomenclatura`) VALUES (:id,:nombre,:abreviatura)");
        $query->bindParam('id', $numero);
        $query->bindParam('nombre', $nombre);
        $query->bindParam('abreviatura', $abreviatura);

        if (!$query->execute()) {
            $msg = "No ejecuta";
            echo json_encode($msg);
            exit();
        }

        $evento = $this->conn()->prepare("INSERT INTO `Eventos`(`CiUsuario`, `titulo`, `descripcion`) VALUES (:ci,:titulo,:descripcion)");
        $idUsuario = $_SESSION['ci'];
        $titulo = "Creacion de Area";
        $descripcion = "Se creo la area " . $abreviatura . "-" . $nombre." ,Perteneciente a la UE ".$numero;
        $evento->bindParam('ci', $idUsuario);
        $evento->bindParam('titulo', $titulo);
        $evento->bindParam('descripcion', $descripcion);
        $evento->execute();
    }

    protected function updateOficina($id,$ue, $nombre, $abreviatura)
    {
        $query = $this->conn()->prepare("UPDATE Area SET `IdUE` = :ue, `Nombre` = :nombre, `Nomenclatura` = :abreviatura WHERE `ID` = :id ;");
        $query->bindParam('id', $id);
        $query->bindParam('ue', $ue);
        $query->bindParam('nombre', $nombre);
        $query->bindParam('abreviatura', $abreviatura);

        if (!$query->execute()) {
            $msg = "No ejecuta";
            echo json_encode($msg);
            exit();
        }

        $evento = $this->conn()->prepare("INSERT INTO `Eventos`(`CiUsuario`, `titulo`, `descripcion`) VALUES (:ci,:titulo,:descripcion)");
        $idUsuario = $_SESSION['ci'];
        $titulo = "Edicion de Area";
        $descripcion = "Se edito la area " . $abreviatura . "-" . $nombre." ,Perteneciente a la UE ".$ue;
        $evento->bindParam('ci', $idUsuario);
        $evento->bindParam('titulo', $titulo);
        $evento->bindParam('descripcion', $descripcion);
        $evento->execute();
    }

    protected function existe($nombre)
    {
        $query = $this->conn()->prepare("SELECT `id` FROM `Area` WHERE `Nombre` = :nombre");
        $query->bindParam('nombre', $nombre);

        if (!$query->execute()) {
            $msg = "No ejecuta 2";
            echo json_encode($msg);
            exit();
        }

        $result = false;
        if ($query->rowCount() > 0) {
            $result = true;
        }
        return $result;
    }

    protected function existeNombre($nombre)
    {
        $query = $this->conn()->prepare("SELECT `id` FROM `Area` WHERE `Nombre` = :nombre");
        $query->bindParam('nombre', $nombre);

        if (!$query->execute()) {
            $msg = "No ejecuta 2";
            echo json_encode($msg);
            exit();
        }

        $result = false;
        if ($query->rowCount() > 0) {
            $result = true;
        }
        return $result;
    }

    protected function existeNomenclatura($nomenclatura)
    {
        $query = $this->conn()->prepare("SELECT `id` FROM `Area` WHERE `Nomenclatura` = :nomenclatura");
        $query->bindParam('nomenclatura', $nomenclatura);

        if (!$query->execute()) {
            $msg = "No ejecuta 2";
            echo json_encode($msg);
            exit();
        }

        $result = false;
        if ($query->rowCount() > 0) {
            $result = true;
        }
        return $result;
    }

    

    protected function existeUE($numero)
    {
        $query = $this->conn()->prepare("SELECT `id` FROM `UE` WHERE `ID` = :numero");
        $query->bindParam('numero', $numero);

        if (!$query->execute()) {
            $msg = "No ejecuta";
            echo json_encode($msg);
            exit();
        }

        $result = false;
        if ($query->rowCount() > 0) {
            $result = true;
        }
        return $result;
    }

    protected function getAll()
    {
        $query = $this->conn()->prepare("SELECT * FROM `Area` WHERE 1");

        if (!$query->execute()) {
            $msg = "No ejecuta";
            echo json_encode($msg);
            exit();
        }

        $unidades = $query->fetchAll(PDO::FETCH_ASSOC);
        return $unidades;
    }

    protected function getUE($ue)
    {
        $query = $this->conn()->prepare("SELECT * FROM `Area` WHERE `IdUE` = :ue");
        $query->bindParam('ue', $ue);

        if (!$query->execute()) {
            $msg = "No ejecuta";
            echo json_encode($msg);
            exit();
        }

        $unidades = $query->fetchAll(PDO::FETCH_ASSOC);
        return $unidades;
    }

    protected function getOficina($id)
    {
        $query = $this->conn()->prepare("SELECT * FROM `Area` WHERE `ID` = :id");
        $query->bindParam('id', $id);

        if (!$query->execute()) {
            $msg = "No ejecuta";
            echo json_encode($msg);
            exit();
        }

        $unidades = $query->fetch(PDO::FETCH_ASSOC);
        return $unidades;
    }

    protected function existsOficina($id)
    {
        $query = $this->conn()->prepare("SELECT `id` FROM `Area` WHERE `ID` = :id");
        $query->bindParam('id', $id);

        if (!$query->execute()) {
            $msg = "No ejecuta";
            echo json_encode($msg);
            exit();
        }

        $result = false;
        if ($query->rowCount() > 0) {
            $result = true;
        }
        return $result;
    }
    
}
