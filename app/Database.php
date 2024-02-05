<?php


//include_once('./config/dbconfig.php');

class Database {
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'sales_management';

    public $link;
    public $error;

    public function __construct() {
        $this->dbConnect();
    }

    protected function dbConnect(){
        try
        {
            $this->link = new PDO("mysql:host=".$this->host.";dbname=".$this->database,$this->user,$this->password);
            $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e)
        {
            echo("Error: " . $e->getMessage());
        }
    }

    public function read($query){
        
    }

    public function insert($query, $data){
        
    }

}