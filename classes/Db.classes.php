<?php

class Db
{
    private $server = "172.24.3.9";
    private $username = "admin";
    private $password = "S3rT3cMEC";
    private $db = "gestor";


    protected function conn()
    {
        try {
            $pdo = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
        } catch (PDOException $e) {
            die($e);
        }
        return $pdo;
    }
}
