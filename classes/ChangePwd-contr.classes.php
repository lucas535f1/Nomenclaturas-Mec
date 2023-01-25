<?php
class ChangePwdContr extends ChangePwd
{

    private $pwd;
    private $pwdRepeat;
    private $ci;

    public function __construct($pwd, $pwdRepeat, $ci)
    {
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->ci = $ci;
    }

    public function changePwd()
    {
        if ($this->emptyInput()) {
            header("location:../cambiarContrasena.php?vacio");
            exit();
        }

        if ($this->differentPwd()) {
            header("location:../cambiarContrasena.php?diferente");
            exit();
        }
        $this->change($this->pwd,$this->ci);
    }

    private function emptyInput()
    {
        $result = false;
        if (empty($this->pwd) || empty($this->pwdRepeat) || empty($this->ci)) {
            $result = true;
        }
        return $result;
    }

    private function differentPwd()
    {
        $result = false;
        if ($this->pwd != $this->pwdRepeat) {
            $result = true;
        }
        return $result;
    }
}
