<?php
class EquipoView extends Equipo
{
    public function fetchAllEquipos()
    {
        return $this->getAllEquipos();
    }

    public function fetchAllEquiposBaja()
    {
        return $this->getAllEquiposBaja();
    }

    public function fetchEquipo($id)
    {
        return $this->getEquipo($id);
    }

    public function equipoExists($id)
    {
        return $this->existsID($id);
    }
}
