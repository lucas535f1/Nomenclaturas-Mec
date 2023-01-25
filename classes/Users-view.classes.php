<?php

class UsersView extends Users{

    public function fetchAllUsers(){
        return $this->getAllUsers();
    }

    public function fetchUser($ci){
        return $this->getUser($ci);
    }

    public function userExists($ci){
        return $this->existsUser($ci);
    }
    
}