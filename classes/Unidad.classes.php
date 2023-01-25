<?php

class Unidad extends Db
{

    protected function setUnidad($numero, $nombre, $abreviatura)
    {
        $query = $this->conn()->prepare("INSERT INTO `UE` VALUES (:id,:nombre,:abreviatura)");
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
        $titulo = "Creacion de unidad ejecutora";
        $descripcion = "Se creo la unidad " . $abreviatura . "-" . $nombre;
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

    protected function getAll()
    {
        $query = $this->conn()->prepare("SELECT * FROM `UE` WHERE 1");

        if (!$query->execute()) {
            $msg = "No ejecuta";
            echo json_encode($msg);
            exit();
        }

        $unidades = $query->fetchAll(PDO::FETCH_ASSOC);
        return $unidades;
    }
}
