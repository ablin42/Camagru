<?php

namespace ablin42;
use PDO;

class database
{
    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;
    private $dsn;
    private $pdo;

    public function __construct($db_name, $db_host = "localhost", $db_user = "root", $db_pass = "root")
    {
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
        $this->dsn = "mysql:dbname={$db_name};host={$db_host}";
    }

    private function getPDO()
    {
        if ($this->pdo === null)
        {
            $pdo = new PDO($this->dsn, $this->db_user, $this->db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    public function query($statement, $class_name = null)
    {
        $req = $this->getPDO()->query($statement);
        if ($class_name === null)
            $data = $req->fetchAll(PDO::FETCH_OBJ);
        else
            $data = $req->fetchAll(PDO::FETCH_CLASS, $class_name);
        return $data;
    }
}