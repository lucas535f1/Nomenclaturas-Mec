<?php
class EditEquipo extends db
{

    protected function updateEquipo($id, $serie, $telefono, $nombre, $apellido, $usuario, $modelo, $observaciones, $idInventario, $so, $oficina, $tipoEquipo, $equipo)
    {
        $query = $this->conn()->prepare("UPDATE `Equipo` SET `IdArea`= :area , `NSerie`=:serie, `Telefono`= :telefono, `Nombre`=:nombre, `Apellido`=:apellido, `Usuario`=:usuario, `NombrePC`=:nombrePC, `IdInventario`=:idInventario, `SistemaOp`=:so,`TipoEquipo`=:tipo,`Modelo`=:modelo,`Observaciones`=:observaciones WHERE `ID`=:id");
        $query->bindParam('id', $id);
        $query->bindParam('area', $oficina);
        $query->bindParam('serie', $serie);
        $query->bindParam('telefono', $telefono);
        $query->bindParam('nombre', $nombre);
        $query->bindParam('apellido', $apellido);
        $query->bindParam('usuario', $usuario);
        $query->bindParam('nombrePC', $equipo);
        $query->bindParam('idInventario', $idInventario);
        $query->bindParam('so', $so);
        $query->bindParam('tipo', $tipoEquipo);
        $query->bindParam('modelo', $modelo);
        $query->bindParam('observaciones', $observaciones);

        if (!$query->execute()) {
            $msg = "Error SQL 2";
            echo json_encode($msg);
            exit();
        }

        $evento = $this->conn()->prepare("INSERT INTO `Eventos`(`CiUsuario`, `titulo`, `descripcion`) VALUES (:ci,:titulo,:descripcion)");
        $titulo = "Edicion PC";
        $descripcion = "Se edito la pc " . $equipo;
        session_start();    
        $ci=$_SESSION['ci'];
        $evento->bindParam('ci', $ci);
        $evento->bindParam('titulo', $titulo);
        $evento->bindParam('descripcion', $descripcion);
        if (!$evento->execute()) {
            $msg = "Error SQL 3";
            echo json_encode($msg);
            exit();
        }
    }


    protected function existsEquipo($pc)
    {
        $query = $this->conn()->prepare("SELECT `ID` FROM `Equipo` WHERE `NombrePC`= :pc AND `bajaLogica`= 0 ");
        $query->bindParam('pc', $pc);

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
