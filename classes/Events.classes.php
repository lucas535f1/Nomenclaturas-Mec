<?php
class Events extends Db
{

    protected function getUserEvents($ci)
    {
        $query = $this->conn()->prepare("SELECT * FROM `Eventos` WHERE `CiUsuario` = :ci ORDER BY `fecha` DESC");
        $query->bindParam('ci', $ci);

        if (!$query->execute()) {
            header("location:../?ci=" . $ci . "&noejecuta");
            exit();
        }

        $events = $query->fetchAll(PDO::FETCH_ASSOC);

        return $events;
    }

    protected function getAllEvents()
    {
        $query = $this->conn()->prepare("SELECT Tecnico.Usuario, Eventos.CiUsuario, Eventos.Descripcion, Eventos.Fecha, Eventos.ID, Eventos.Titulo FROM Tecnico  INNER JOIN Eventos ON Eventos.CiUsuario=Tecnico.CI ORDER BY fecha DESC");

        if (!$query->execute()) {
            header("location:../eventos.php?noejecuta");
            exit();
        }

        $events = $query->fetchAll(PDO::FETCH_ASSOC);

        return $events;
    }
}
