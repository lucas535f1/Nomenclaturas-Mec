<?php
class EquipoLogicaContr extends EquipoLogica
{
    public function bajaLogica($id)
    {
        $this->baja($id);
    }

    public function eliminar($id)
    {
        $this->remove($id);
    }


    public function altaLogica($id, $equipo)
    {

        if ($this->existsEquipo($equipo)) {
            // $msg = "Ya existe un equipo con ese nombre";
            // echo json_encode($msg);
            header("Location: ../equipo.php?id=" . $id );
            exit();
        } else {
            $this->alta($id);
        }
    }
}
