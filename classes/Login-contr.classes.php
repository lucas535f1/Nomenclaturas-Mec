<?php
class LoginContr extends Login
{
    private $user;
    private $pwd;

    public function __construct($user, $pwd)
    {
        $this->user = $user;
        $this->pwd = $pwd;
    }  

    public function login()
    {
        if ($this->emptyInput()) {
            header("location:../iniciarSesion.php?vacio");
            exit();
        }
        $this->getUser($this->user,$this->pwd);
    }

    private function emptyInput()
    {
        $result = false;
        if (empty($this->user) || empty($this->pwd)) {
            $result = true;
        }
        return $result;
    }

}
