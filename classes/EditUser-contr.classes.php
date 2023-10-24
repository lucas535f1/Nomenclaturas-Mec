<?php
class EditUserContr extends EditUser
{
    private $ci;
    private $ciVieja;
    private $mail;
    private $mailViejo;
    private $usuario;
    private $usuarioViejo;
    private $pwd;
    private $nombre;
    private $apellido;
    private $permisos;


    // public function __construct()
    // {

    // }

    public function __construct($ci, $ciVieja, $mail, $mailViejo, $usuario, $usuarioViejo, $pwd, $nombre, $apellido, $permisos)
    {
        $this->ci = $ci;
        $this->ciVieja = $ciVieja;
        $this->mail = $mail;
        $this->mailViejo = $mailViejo;
        $this->usuario = $usuario;
        $this->usuarioViejo = $usuarioViejo;
        $this->pwd = $pwd;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->permisos = $permisos;
    }

    public function editUser()
    {
        if ($this->emptyInput()) {
            $msg[0] = "No pueden haber campos vacios";
            $msg[1] = false;
            echo json_encode($msg);
            exit();
        }

        if (!$this->emptyPwd()) {
            $this->changePwd($this->ciVieja, $this->pwd);
        }

        $this->updateUser($this->ci, $this->ciVieja, $this->mail, $this->usuario, $this->nombre, $this->apellido, $this->permisos, $this->distinto());
    }

    private function emptyInput()
    {

        $result = false;
        if (empty($this->mail) || empty($this->nombre) || empty($this->apellido) || !isset($this->permisos) || empty($this->ci) || empty($this->usuario)) {
            $result = true;
        }
        return $result;
    }

    private function emptyPwd()
    {
        $result = false;
        if (empty($this->pwd)) {
            $result = true;
        }
        return $result;
    }

    private function distintaCI()
    {
        $result = false;
        if ($this->mail != $this->mailViejo) {
            $result = true;
        }
        return $result;
    }

    private function distintoMail()
    {
        $result = false;
        if ($this->mail != $this->mailViejo) {
            $result = true;
        }
        return $result;
    }

    private function distintoUser()
    {
        $result = false;
        if ($this->usuario != $this->usuarioViejo) {
            $result = true;
        }
        return $result;
    }

    private function distinto()
    {
        $result = false;
        if ($this->distintaCI() && $this->distintoMail() && $this->distintoUser()) {
            $result = true;
        }
        return $result;
    }
}
