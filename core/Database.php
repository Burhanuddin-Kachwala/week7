<?php

namespace core;
use PDO,PDOException;

class Database
{
    public  $servername = "localhost", $username = "root", $password = "", $dbname = 'expense_tracker';
    public $conn;
    public $statement;
    public function __construct()
    {
        
        $connectionString = "mysql:host=$this->servername;dbname=$this->dbname";
        
        try{
            $this->conn = new PDO($connectionString,$this->username, $this->password);
             // Set PDO error mode to exception
             $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             
        }
        catch(PDOException $e){
            dd($e);
            

        }
        
    }
    public function query($query ,$params =[])

    {
        
        $this->statement = $this->conn->prepare($query);
        $this->statement->execute($params);
        //$results = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $this;

    }
    public function find()
    {
        $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) == 1) {
            return $result[0];
        }
        
        return $result;
    }
    public function findOrAbort(){
        $result = $this->find();
        if(!$result){
            abort(404);
        }
        return $result;
    }
}