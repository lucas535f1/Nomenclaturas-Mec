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
            $msg="Debe completar los campos";
            echo json_encode($msg);
            exit();
        }

        if ($this->differentPwd()) {
            $msg="Las contraseñas son distintas";
            echo json_encode($msg);
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
