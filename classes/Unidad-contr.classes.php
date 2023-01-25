<?php
class UnidadContr extends Unidad
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

    public function createUnidad()
    {
        if ($this->emptyInput()) {
            $msg = "Debe completar los campos";
            echo json_encode($msg);
            exit();
        }
        if ($this->existe($this->numero,$this->nombre, $this->abreviatura)) {
            $msg = "El numero, nombre y/o abreviatura ya existe";
            echo json_encode($msg);
            exit();
        }
        $this->setUnidad($this->numero, $this->nombre, $this->abreviatura);
    }

    private function emptyInput()
    {
        $result = false;
        if (empty($this->numero) || empty($this->nombre) || empty($this->abreviatura)) {
            $result = true;
        }
        return $result;
    }
}
