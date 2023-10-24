<?php
class Name extends Db
{
    protected function generateNumber($name)
    {
        $query = $this->conn()->prepare("SELECT `NombrePC` FROM `Equipo` WHERE `NombrePC` LIKE :nombre AND `bajaLogica` = 0 ORDER BY `NombrePC`");
        $query->bindParam('nombre', $name);

        if (!$query->execute()) {
            $msg = "No ejecuta";
            echo json_encode($msg);
            exit();
        }
        $names = $query->fetchAll(PDO::FETCH_ASSOC);
        return $names;
    }

}
