<?php
namespace app;

use database\Database;

class Customers{
    public $name;
    public $email;
    public $db;

    public function __construct($name,$email){
        $tis->db = new Database();
        $this->name = $name;
        $this->email = $email;
    }

    public function save()
    {
        
    }
}