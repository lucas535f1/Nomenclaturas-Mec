<?php
class Unidad extends Db
{

    protected function setUnidad($numero, $nombre, $abreviatura)
    {
        $query = $this->conn()->prepare("INSERT INTO `UE` (`ID`, `Nombre`, `Nomenclatura`) VALUES (:id,:nombre,:abreviatura)");
        $query->bindParam('id', $numero);
        $query->bindParam('nombre', $nombre);
        $query->bindParam('abreviatura', $abreviatura);

        if (!$query->execute()) {
            $msg = "No ejecuta 1";
            echo json_encode($msg);
            exit();
        }

        $evento = $this->conn()->prepare("INSERT INTO `Eventos`(`CiUsuario`, `titulo`, `descripcion`) VALUES (:ci,:titulo,:descripcion)");
        $idUsuario = $_SESSION['ci'];
        $titulo = "Creacion de unidad ejecutora";
        $descripcion = "Se creo la unidad " . $abreviatura . "-" . $nombre;
        $evento->bindParam('ci', $idUsuario);
        $evento->bindParam('titulo', $titulo);
        $evento->bindParam('descripcion', $descripcion);
        $evento->execute();
    }

    protected function updateUnidad($numero, $idVieja, $nombre, $abreviatura)
    {
        $query = $this->conn()->prepare("UPDATE `UE` SET `ID` = :id, `Nombre` = :nombre, `Nomenclatura` = :abreviatura WHERE `ID` = :idVieja ;");
        $query->bindParam('id', $numero);
        $query->bindParam('idVieja', $idVieja);
        $query->bindParam('nombre', $nombre);
        $query->bindParam('abreviatura', $abreviatura);

        if (!$query->execute()) {
            $msg = "No ejecuta 1";
            echo json_encode($msg);
            exit();
        }

        $evento = $this->conn()->prepare("INSERT INTO `Eventos`(`CiUsuario`, `titulo`, `descripcion`) VALUES (:ci,:titulo,:descripcion)");
        $idUsuario = $_SESSION['ci'];
        $titulo = "Edicion de unidad ejecutora";
        $descripcion = "Se edito la unidad " . $abreviatura . "-" . $nombre;
        $evento->bindParam('ci', $idUsuario);
        $evento->bindParam('titulo', $titulo);
        $evento->bindParam('descripcion', $descripcion);
        $evento->execute();
    }

    protected function existe($numero, $nombre, $abreviatura)
    {
        $query = $this->conn()->prepare("SELECT `id` FROM `UE` WHERE `ID` = :numero OR `Nombre` = :nombre OR `Nomenclatura` = :abreviatura");
        $query->bindParam('numero', $numero);
        $query->bindParam('nombre', $nombre);
        $query->bindParam('abreviatura', $abreviatura);

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

    protected function existeID($id)
    {
        $query = $this->conn()->prepare("SELECT `id` FROM `UE` WHERE `ID` = :id");
        $query->bindParam('id', $id);

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
        $query = $this->conn()->prepare("SELECT `id` FROM `UE` WHERE `Nombre` = :nombre");
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
        $query = $this->conn()->prepare("SELECT `id` FROM `UE` WHERE `Nomenclatura` = :nomenclatura");
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

    protected function existsUE($id)
    {
        $query = $this->conn()->prepare("SELECT `id` FROM `UE` WHERE `ID` = :id");
        $query->bindParam('id', $id);

        if (!$query->execute()) {
            $msg = "No ejecuta 3";
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
        $query = $this->conn()->prepare("SELECT * FROM `UE` WHERE 1");

        if (!$query->execute()) {
            $msg = "No ejecuta 4";
            echo json_encode($msg);
            exit();
        }

        $unidades = $query->fetchAll(PDO::FETCH_ASSOC);
        return $unidades;
    }

    protected function getAreas()
    {
        $query = $this->conn()->prepare("SELECT DISTINCT UE.ID ID, UE.Nombre Nombre, UE.Nomenclatura Nomenclatura, UE.bajaLogica bajaLogica FROM (UE 
        INNER JOIN Area ON UE.ID=Area.IdUE) 
        WHERE UE.ID IN( SELECT IdUE FROM Area);");

        if (!$query->execute()) {
            $msg = "No ejecuta 4";
            echo json_encode($msg);
            exit();
        }

        $unidades = $query->fetchAll(PDO::FETCH_ASSOC);
        return $unidades;
    }

    protected function getUE($id)
    {
        $query = $this->conn()->prepare("SELECT * FROM `UE` WHERE `ID` = :id");
        $query->bindParam('id', $id);
        if (!$query->execute()) {
            $msg = "No ejecuta 5";
            echo json_encode($msg);
            exit();
        }

        $unidades = $query->fetch(PDO::FETCH_ASSOC);
        return $unidades;
    }
}
