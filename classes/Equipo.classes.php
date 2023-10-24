<?php
class Equipo extends Db
{

    protected function insertEquipo($serie, $telefono, $nombre, $apellido, $usuario, $modelo, $observaciones, $idInventario, $so, $oficina, $tipoEquipo, $equipo)
    {
        $query = $this->conn()->prepare("INSERT INTO `Equipo`(`CiTecnico`, `IdArea`, `NSerie`, `Telefono`, `Nombre`, `Apellido`, `Usuario`, `NombrePC`, `IdInventario`, `SistemaOp`,`TipoEquipo`,`Modelo`,`Observaciones`) VALUES (:ciTecnico,:area,:serie,:telefono,:nombre,:apellido,:usuario,:nombrePC,:idInventario,:so,:tipo,:modelo,:observaciones)");
        session_start();
        $ci = $_SESSION['ci'];
        $query->bindParam('ciTecnico', $ci);
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
        $titulo = "Registro PC";
        $descripcion = "Se registro la pc " . $equipo;

        $evento->bindParam('ci', $ci);
        $evento->bindParam('titulo', $titulo);
        $evento->bindParam('descripcion', $descripcion);
        if (!$evento->execute()) {
            $msg = "Error SQL 3";
            echo json_encode($msg);
            exit();
        }
    }

    protected function getAllEquipos()
    {
        $query = $this->conn()->prepare("SELECT Equipo.*, UE.Nombre 'ue', Area.Nombre 'oficina', Tecnico.Usuario 'nombreTecnico' FROM Equipo INNER JOIN Area on Equipo.IdArea = Area.ID INNER JOIN UE on Area.idUE = UE.ID INNER JOIN Tecnico on Equipo.CiTecnico = Tecnico.CI WHERE Equipo.bajaLogica = 0");

        if (!$query->execute()) {
            $msg = "Error SQL";
            echo json_encode($msg);
            exit();
        }

        $equipos = $query->fetchAll(PDO::FETCH_ASSOC);

        return $equipos;
    }

    protected function getAllEquiposBaja()
    {
        $query = $this->conn()->prepare("SELECT Equipo.*, UE.Nombre 'ue', Area.Nombre 'oficina', Tecnico.Usuario 'nombreTecnico' FROM Equipo INNER JOIN Area on Equipo.IdArea = Area.ID INNER JOIN UE on Area.idUE = UE.ID INNER JOIN Tecnico on Equipo.CiTecnico = Tecnico.CI WHERE Equipo.bajaLogica = 1");

        if (!$query->execute()) {
            $msg = "Error SQL";
            echo json_encode($msg);
            exit();
        }

        $equipos = $query->fetchAll(PDO::FETCH_ASSOC);

        return $equipos;
    }

    protected function getEquipo($id)
    {
        $query = $this->conn()->prepare("SELECT Equipo.*, UE.Nombre 'ue', UE.ID 'ueID',UE.Nomenclatura 'ueNomenclatura', Area.Nombre 'oficina', Area.Nomenclatura 'oficinaNomenclatura', Tecnico.Usuario 'nombreTecnico' FROM Equipo INNER JOIN Area on Equipo.IdArea = Area.ID INNER JOIN UE on Area.idUE = UE.ID INNER JOIN Tecnico on Equipo.CiTecnico = Tecnico.CI WHERE Equipo.id = :id");
        $query->bindParam('id', $id);
        if (!$query->execute()) {
            $msg = "Error SQL";
            echo json_encode($msg);
            exit();
        }

        $equipo = $query->fetch(PDO::FETCH_ASSOC);

        return $equipo;
    }

    protected function existsEquipo($pc)
    {
        $query = $this->conn()->prepare("SELECT `ID` FROM `Equipo` WHERE `NombrePC`= :pc AND `bajaLogica` = 0 ");
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

    protected function existsID($id)
    {
        $query = $this->conn()->prepare("SELECT `ID` FROM `Equipo` WHERE `ID`= :id ");
        $query->bindParam('id', $id);

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
