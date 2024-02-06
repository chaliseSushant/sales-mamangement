<?php

include_once 'Database.php';

class Customers{
    private $name;
    private $email;

    public function __construct($name,$email){
        $this->db = new Database();
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * Save Customer data
     * @return {Integer | String}
     */
    public function save()
    {
        $duplicate = $this->checkCustomer($this->email);
        if(!$duplicate){
                $query = "INSERT INTO customers(customer_name,customer_email) VALUES(:name,:email)";
                $this->db->query($query);
                $this->db->bind(':name',$this->name);
                $this->db->bind(':email',$this->email);
                $this->db->execute();
                $last_id = $this->db->lastInsertId();
        
                return $last_id;
        }else{
            return $duplicate[0]['customer_id'];
        }
        
       
    }

    /**
     * Check for duplicate Customer
     * @return {Array}
     */
    public function checkCustomer(){
        $query = "SELECT customer_id FROM customers WHERE customer_email = '.$this->email.'";
        $this->db->query($query);
        $exists = $this->db->result();

        return $exists;
    }
}