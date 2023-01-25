<?php
class SingupContr extends Singup
{
    private $ci;
    private $mail;
    private $usuario;
    private $pwd;
    private $nombre;
    private $apellido;
    private $permisos;

    public function __construct($ci, $mail, $usuario, $pwd, $nombre, $apellido, $permisos)
    {
        $this->ci = $ci;
        $this->mail = $mail;
        $this->usuario = $usuario;
        $this->pwd = $pwd;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->permisos = $permisos;
    }

    public function createUser()
    {
        if ($this->emptyInput()) {
            header("location:../crearUsuarios.php?vacio");
            exit();
        }

        // if ($this->validateMail()) {
        //     header("location:../crearUsuarios.php?mailinvalido");
        //     exit();
        // }

        $this->singupUser($this->ci, $this->mail, $this->usuario, $this->pwd, $this->nombre, $this->apellido, $this->permisos);
    }

    private function emptyInput()
    {

        $result = false;
        if (empty($this->mail) || empty($this->pwd) || empty($this->nombre) || empty($this->apellido) || !isset($this->permisos) || !isset($this->ci) || !isset($this->usuario)) {
            $result = true;
        }
        return $result;
    }

    private function validateMail()
    {
        $result = false;
        if (!filter_var($this->mail, FILTER_VALIDATE_EMAIL)) {
            $result = true;
        }
        return $result;
    }
}
