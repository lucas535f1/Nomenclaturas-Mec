<?php

class   Login extends db{

    protected function getUser ($user,$pwd){
        $query = $this->conn()->prepare("SELECT * FROM `Tecnico` WHERE  `Usuario` = :user");
        $query->bindParam('user', $user);

        if(!$query->execute()){
            header("location:../iniciarSesion.php?noejecuta");
            exit();
        }

        $userArray = $query->fetch(PDO::FETCH_ASSOC);

        if($query->rowCount()==0){
            header("location:../iniciarSesion.php?noexiste");
            exit();
        }
        
        if(!password_verify($pwd,$userArray['Pass'])){
            header("location:../iniciarSesion.php?contrasenamal");
            exit();
        }

        session_start();
        $_SESSION['ci'] = $userArray['CI'];
        $_SESSION['mail'] = $userArray['Mail'];
        $_SESSION['nombre'] = $userArray['Nombre'];
        $_SESSION['apellido'] = $userArray['Apellido'];
        $_SESSION['usuario'] = $userArray['Usuario'];
        $_SESSION['permisos'] = $userArray['Permisos'];
        $_SESSION['pwdDefault'] = $userArray['PassDefault'];
    }
    
}
