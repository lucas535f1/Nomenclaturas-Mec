<?php
class Db
{
    // private $server = "localhost";
    // private $username = "root";
    // private $password = "";
    // private $db = "gestor";

    private $server = "equipos.mec.local";
    private $username = "admin-mec";
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
