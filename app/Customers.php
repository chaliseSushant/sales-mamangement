<?php

include 'Database.php';

class Customers{
    public $name;
    public $email;

    public function __construct($name,$email){
        $this->db = new Database();
        $this->name = $name;
        $this->email = $email;
    }

    public function save()
    {
       if(!$this->checkCustomer()){
            $query = "INSERT INTO customers(customer_name,customer_email) VALUES(:name,:email)";
            // $customer_data = [":name"=>$this->name,":email"=>$this->email];
            $this->db->query($query);
            $this->db->bind(':name',$this->name);
            $this->db->bind(':email',$this->email);
            $this->db->execute();
            $last_id = $this->db->lastInsertId();
    
            return $last_id;
       }
       
    }

    public function checkCustomer(){
        $query = "SELECT EXISTS(SELECT * FROM customers WHERE customer_email = '".$this->email."')";
        $this->db->query($query);
        $exists = $this->db->execute();
       var_dump($exists);

        return $exists;
    }
}