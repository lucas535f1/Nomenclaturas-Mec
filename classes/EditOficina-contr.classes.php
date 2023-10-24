<?php
class OficinaContr extends Oficina
{
    private $id;
    private $ue;
    private $nombre;
    private $nombreViejo;
    private $abreviatura;
    private $abreviaturaVieja;
    private $null;

    public function __construct($id, $ue, $nombre, $nombreViejo, $abreviatura, $abreviaturaVieja)
    {
        $this->abreviatura = $abreviatura;
        $this->abreviaturaVieja = $abreviaturaVieja;
        $this->nombre = $nombre;
        $this->nombreViejo = $nombreViejo;
        $this->id = $id;
        $this->$ue = $ue;
        $this->null = $ue;
        $this->ue = $this->null;

    }

    public function editOficina()
    {
        if ($this->emptyInput()) {
            $msg = "Debe completar los campos";
            echo json_encode($msg);
            exit();
        }

        // if ($this->abreviatura != $this->abreviaturaVieja) {
        //     if($this->existeNomenclatura($this->abreviatura)){
        //     $msg = "La abreviatura ya existe";
        //     echo json_encode($msg);
        //     exit();
        //     }
        // }

        if ($this->nombre != $this->nombreViejo) {
            if($this->existeNombre($this->nombre)){
            $msg = "El nombre ya existe";
            echo json_encode($msg);
            exit();
            }
        }

        if (!$this->existeUE($this->ue)) {
            $msg = "La unidad ejecutora no existe";
            echo json_encode($msg);
            exit();
        }
        
        $this->updateOficina($this->id, $this->ue, $this->nombre, $this->abreviatura);
    }

    private function emptyInput()
    {
        $result = false;
        if ($this->ue<0 || $this->id<0 || empty($this->nombre) || empty($this->abreviatura)) {
            $result = true;
        }
        return $result;
    }
}
