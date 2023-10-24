<?php
class EquipoLogica extends Db
{
    protected function baja($id)
    {
        $query = $this->conn()->prepare("UPDATE `Equipo` SET `bajaLogica`= 1 WHERE  `ID` = :id");
        $query->bindParam('id', $id);
        $query->execute();

        $evento = $this->conn()->prepare("INSERT INTO `Eventos`(`CiUsuario`, `titulo`, `descripcion`) VALUES (:ci,:titulo,:descripcion)");
        $titulo = "Baja PC";
        $descripcion = "Se dio de baja la PC de id: " . $id;
        session_start();
        $ci = $_SESSION['ci'];
        $evento->bindParam('ci', $ci);
        $evento->bindParam('titulo', $titulo);
        $evento->bindParam('descripcion', $descripcion);
        $evento->execute();
    }

    protected function remove($id)
    {
        $query = $this->conn()->prepare("DELETE FROM `Equipo` WHERE  `ID` = :id");
        $query->bindParam('id', $id);
        $query->execute();

        $evento = $this->conn()->prepare("INSERT INTO `Eventos`(`CiUsuario`, `titulo`, `descripcion`) VALUES (:ci,:titulo,:descripcion)");
        $titulo = "Eliminacion PC";
        $descripcion = "Se elimino definitivamente la PC de id: " . $id;
        session_start();
        $ci = $_SESSION['ci'];
        $evento->bindParam('ci', $ci);
        $evento->bindParam('titulo', $titulo);
        $evento->bindParam('descripcion', $descripcion);
        $evento->execute();
    }

    protected function alta($id)
    {
        $query = $this->conn()->prepare("UPDATE `Equipo` SET `bajaLogica`= 0 WHERE  `ID` = :id");
        $query->bindParam('id', $id);
        $query->execute();

        $evento = $this->conn()->prepare("INSERT INTO `Eventos`(`CiUsuario`, `titulo`, `descripcion`) VALUES (:ci,:titulo,:descripcion)");
        $titulo = "Alta PC";
        $descripcion = "Se dio de alta la PC de id: " . $id;
        session_start();
        $ci = $_SESSION['ci'];
        $evento->bindParam('ci', $ci);
        $evento->bindParam('titulo', $titulo);
        $evento->bindParam('descripcion', $descripcion);
        $evento->execute();
    }
    
    protected function existsEquipo($pc)
    {
        $query = $this->conn()->prepare("SELECT `ID` FROM `Equipo` WHERE `NombrePC`= :pc AND `bajaLogica` = 0 ");
        $query->bindParam('pc',$pc );
        
        if (!$query->execute()) {
            $msg = "Error SQL 1";
            echo json_encode($msg);
            exit();
        }
        $result = true;
        if ($query->rowCount() == 0) {
            $result = false;
        }
        return $result;
    }
}
