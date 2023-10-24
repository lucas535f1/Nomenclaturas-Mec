<?php
class   Login extends db{

    protected function getUser ($user,$pwd){
        $query = $this->conn()->prepare("SELECT * FROM `Tecnico` WHERE  `Usuario` = :user");
        $query->bindParam('user', $user);

        if(!$query->execute()){
            $msg="Error SQL";
            echo json_encode($msg);
            exit();
        }

        $userArray = $query->fetch(PDO::FETCH_ASSOC);

        if($query->rowCount()==0){
            $msg="El usuario no existe";
            echo json_encode($msg);
            exit();
        }
        
        if(!password_verify($pwd,$userArray['Pass'])){
            $msg="Contraseña incorrecta";
            echo json_encode($msg);
            exit();
        }

        if($userArray['Permisos']==0){
            $msg="Usuario Deshabilitado";
            echo json_encode($msg);
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
