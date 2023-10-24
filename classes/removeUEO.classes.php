<?php
class removeUEO extends Db
{

    protected function removeO($id)
    {
        $query = $this->conn()->prepare("DELETE FROM `Area` WHERE  `ID` = :id");
        $query->bindParam('id', $id);
        if (!$query->execute()) {
            $msg = "No ejecuta";
            echo json_encode($msg);
            exit();
        }

        $evento = $this->conn()->prepare("INSERT INTO `Eventos`(`CiUsuario`, `titulo`, `descripcion`) VALUES (:ci,:titulo,:descripcion)");
        $titulo = "Eliminacion UE";
        $descripcion = "Se elimino definitivamente la UE de id: " . $id;
        $ci = $_SESSION['ci'];
        $evento->bindParam('ci', $ci);
        $evento->bindParam('titulo', $titulo);
        $evento->bindParam('descripcion', $descripcion);
        $evento->execute();
    }

    protected function removeUE($id)
    {
        $query = $this->conn()->prepare("DELETE FROM `UE` WHERE  `ID` = :id");
        $query->bindParam('id', $id);
        if (!$query->execute()) {
            $msg = "No ejecuta";
            echo json_encode($msg);
            exit();
        }

        $evento = $this->conn()->prepare("INSERT INTO `Eventos`(`CiUsuario`, `titulo`, `descripcion`) VALUES (:ci,:titulo,:descripcion)");
        $titulo = "Eliminacion UE";
        $descripcion = "Se elimino definitivamente la UE de id: " . $id;
        $ci = $_SESSION['ci'];
        $evento->bindParam('ci', $ci);
        $evento->bindParam('titulo', $titulo);
        $evento->bindParam('descripcion', $descripcion);
        $evento->execute();
    }

    protected function emptyO($id)
    {
        $query = $this->conn()->prepare("SELECT `idArea`FROM `Equipo` WHERE  `IdArea` = :id");
        $query->bindParam('id', $id);
        if (!$query->execute()) {
            $msg = "No ejecuta";
            echo json_encode($msg);
            exit();
        }

        if ($query->rowCount() == 0) {
            return true;
        } else {
            return false;
        }
    }

    protected function emptyUE($id)
    {
        $query = $this->conn()->prepare("SELECT `IdUE`FROM `Area` WHERE  `IdUE` = :id");
        $query->bindParam('id', $id);
        if (!$query->execute()) {
            $msg = "No ejecuta";
            echo json_encode($msg);
            exit();
        }

        if ($query->rowCount() == 0) {
            return true;
        } else {
            return false;
        }
    }
}
