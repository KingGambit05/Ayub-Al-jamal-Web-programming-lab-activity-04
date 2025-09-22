<?php
class Database{

    private $host = "localhost";
    private $name = "root";
    private $password = "";
    private $dbname = "bookstore1";

    protected $conn;

    public function connect(){
        $this-> conn = new PDO("mysql:host=$this->host; dbname=$this->dbname", $this->name, $this->password); 

        return $this->conn;
    }

}


// $obj = new Database();

// var_dump($obj->connect());