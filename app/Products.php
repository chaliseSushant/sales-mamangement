<?php

include_once 'Database.php';


class Products {
    public $id;
    public $name;
    public $price;

    public function __construct($id,$name,$price){
        $this->db = new Database();
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }
    /**
     * Save Product data
     * @return {Integer | String}
     */
    public function save()
    {
        $duplicate = $this->checkDuplicateProduct();
        if(!$duplicate){
                $query = "INSERT INTO products(product_id,product_name,price) VALUES(:id,:name,:price)";
                // $customer_data = [":name"=>$this->name,":email"=>$this->email];
                $this->db->query($query);
                $this->db->bind(':id',$this->id);
                $this->db->bind(':name',$this->name);
                $this->db->bind(':price',$this->price);
                $this->db->execute();
                $last_id = $this->db->lastInsertId();
        
                 return $last_id;
                
        }else{
            return $duplicate[0]['product_id'];
        }
        
    }
    /**
     * Check for duplicate Product
     * @return {Array}
     */
    public function checkDuplicateProduct(){
        $query = "SELECT * FROM products WHERE product_id = '".$this->id."'";
        $this->db->query($query);
        $exists = $this->db->resultSet();
      

        return $exists;
    }
}