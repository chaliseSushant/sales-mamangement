<?php
namespace database;

//include_once('./config/dbconfig.php');

class Database {
    public $host = 'mysql';
    public $user = 'root';
    public $password = 'root';
    public $database = 'sales_management';

    public $link;
    public $error;

    public function __construct() {
        $this->dbConnect();
    }

    public function dbConnect(){
        try
        {
            $this->link = new PDO("mysql:host=".$host.";dbname=".$database,$user,$password);
            $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e)
        {
            echo("Error: " . $e->getMessage());
        }
    }

}