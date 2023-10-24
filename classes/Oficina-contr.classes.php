<?php

class OficinaContr extends Oficina
{
    private $numero;
    private $nombre;
    private $abreviatura;

    public function __construct($numero, $nombre, $abreviatura)
    {
        $this->abreviatura = $abreviatura;
        $this->nombre = $nombre;
        $this->numero = $numero;
    }

    public function createOficina()
    {
        if ($this->emptyInput()) {
            $msg = "Debe completar los campos";
            echo json_encode($msg);
            exit();
        }

        if ($this->existe($this->nombre)) {
            $msg = "El nombre ya existe";
            echo json_encode($msg);
            exit();
        }

        if (!$this->existeUE($this->numero)) {
            $msg = "La unidad ejecutora no existe";
            echo json_encode($msg);
            exit();
        }        

        $this->setOficina($this->numero, $this->nombre, $this->abreviatura);

    }

    private function emptyInput()
    {
        $result = false;
        if (!isset($this->numero) || empty($this->nombre) || empty($this->abreviatura)) {
            $result = true;
        }
        return $result;
    }

}
