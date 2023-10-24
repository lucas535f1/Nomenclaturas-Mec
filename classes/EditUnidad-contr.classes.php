<?php
class OficinaContr extends Unidad
{
    private $id;
    private $idViejo;
    private $nombre;
    private $nombreViejo;
    private $abreviatura;
    private $abreviaturaVieja;
    private $null;

    public function __construct($id, $idViejo, $nombre, $nombreViejo, $abreviatura, $abreviaturaVieja)
    {
        $this->abreviatura = $abreviatura;
        $this->abreviaturaVieja = $abreviaturaVieja;
        $this->nombre = $nombre;
        $this->nombreViejo = $nombreViejo;
        $this->id = $id;
        $this->$idViejo = $idViejo;
        $this->null = $idViejo;
        $this->idViejo = $this->null;

    }

    public function editUnidad()
    {
        if ($this->emptyInput()) {
            $msg = "Debe completar los campos";
            echo json_encode($msg);
            exit();
        }

        if ($this->id != $this->idViejo) {
            if($this->existeID($this->id)){
            $msg = "El ID ya existe";
            echo json_encode($msg);
            exit();
            }
        }

        if ($this->abreviatura != $this->abreviaturaVieja) {
            if($this->existeNomenclatura($this->abreviatura)){
            $msg = "La abreviatura ya existe";
            echo json_encode($msg);
            exit();
            }
        }

        if ($this->nombre != $this->nombreViejo) {
            if($this->existeNombre($this->nombre)){
            $msg = "El nombre ya existe";
            echo json_encode($msg);
            exit();
            }
        }
        
        $this->updateUnidad($this->id, $this->idViejo, $this->nombre, $this->abreviatura);
    }

    private function emptyInput()
    {
        $result = false;
        if ($this->id<0 || empty($this->nombre) || empty($this->abreviatura)) {
            $result = true;
        }
        return $result;
    }
}
