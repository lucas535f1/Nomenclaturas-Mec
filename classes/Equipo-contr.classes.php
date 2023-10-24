<?php
class EquipoContr extends Equipo
{
    private $serie;
    private $telefono;
    private $nombre;
    private $apellido;
    private $usuario;
    private $modelo;
    private $observaciones;
    private $idInventario;
    private $so;
    private $oficina;
    private $tipoEquipo;
    private $equipo;

    public function __construct($serie, $telefono, $nombre, $apellido, $usuario, $modelo, $observaciones, $idInventario, $so, $oficina, $tipoEquipo, $equipo)
    {
        $this->serie = $serie;
        $this->telefono = $telefono;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->usuario = $usuario;
        $this->modelo = $modelo;
        $this->observaciones = $observaciones;
        $this->idInventario = $idInventario;
        $this->so = $so;
        $this->oficina = $oficina;
        $this->tipoEquipo = $tipoEquipo;
        $this->equipo = $equipo;
    }

    public function createEquipo()
    {
        if ($this->emptyInput()) {
            $msg = "Debe completar los campos";
            echo json_encode($msg);
            exit();
        }

        if ($this->existsEquipo($this->equipo)) {
            $msg = "Ya existe un equipo con ese nombre";
            echo json_encode($msg);
            exit();
        }

        $this->insertEquipo($this->serie, $this->telefono, $this->nombre, $this->apellido, $this->usuario, $this->modelo, $this->observaciones, $this->idInventario, $this->so, $this->oficina, $this->tipoEquipo, $this->equipo);

    }

    private function emptyInput()
    {
        $result = false;
        if (empty($this->equipo) || empty($this->serie) || empty($this->idInventario) || empty($this->oficina) || empty($this->tipoEquipo)) {
            $result = true;
        }
        return $result;
    }
}
