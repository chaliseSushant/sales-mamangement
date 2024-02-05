<?php
namespace app;

use database\Database;

class Customers{
    public $name;
    public $email;

    public function __construct($name,$email){
        $this->name = $name;
        $this->email = $email;
    }

    public function save()
    {
        
    }
}