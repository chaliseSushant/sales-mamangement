<?php

include_once 'Customers.php';
include_once 'Products.php';


class Sales {

    public $db;
    private $sales_id;
    private $customer_id;
    private $product_id;
    private $sales_date;

    public function __construct(){
        $this->db = new Database();
    }
    /**
     * Upload the json file and save data to database
     * 
     */
    public function addSales(){
       
        $fileName = $_FILES['file_json']['name'];
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $tmpName = $_FILES['file_json']['tmp_name'];
        // Check if the file is a JSON file
        if ($fileType !== 'json') {
            die("Error: Please upload a valid JSON file.");
        }
        // Read JSON file content
        $jsonContent = file_get_contents($tmpName);
       // Decode JSON data
       $salesData = json_decode($jsonContent, true);
       $customers = [];
       foreach($salesData as $data){
       
        $customer = new Customers($data['customer_name'],$data['customer_mail']);
        $this->customer_id = (int)$customer->save();
        $product = new Products($data['product_id'],$data['product_name'],$data['product_price']);
        $this->product_id = (int)$product->save();
        $this->sales_id = $data['sale_id'];
        $this->sales_date = $data['sale_date'];
        if(!$this->checkDuplicateSales()){
            $this->save();
        }else{
            continue;
        }
       }
        
    }

    /**
     * Save sales data
     */
    public function save()
    {
       
        $query = "INSERT INTO sales (sale_id,customer_id,product_id,sale_date) VALUES(:id,:customer_id,:product_id,:date)";
        // $customer_data = [":name"=>$this->name,":email"=>$this->email];
        $this->db->query($query); 
        $this->db->bind(':id',$this->sales_id);
        $this->db->bind(':customer_id',$this->customer_id);
        $this->db->bind(':product_id',$this->product_id);
        $this->db->bind(':date',$this->sales_date);
        $this->db->execute();
        $last_id = $this->db->lastInsertId();

        return $last_id;
        
       
    }
    /**
     * Get sales data with filter parameters product, price and customer name
     * @return {Array}
     */
    public function getSales(){
        $searchTerm = isset($_GET['search_term'])?$_GET['search_term']:"";
        $query = "SELECT sales.sale_date as sales_date,products.product_name as product, products.price as price,customers.customer_name as customer,customers.customer_email as email 
                FROM ((sales INNER JOIN products on sales.product_id = products.product_id) INNER JOIN customers on sales.customer_id = customers.customer_id) 
                WHERE (products.product_name LIKE '%".$searchTerm."%' OR customers.customer_name LIKE '%".$searchTerm."%' OR products.price LIKE '%".$searchTerm."%')";
        $this->db->query($query);
        $data = $this->db->resultSet();

        return $data;

    }

    /**
     * Check for duplicate Sales Entry
     * @return {Array}
     */
    public function checkDuplicateSales() {
        $query = "SELECT * FROM sales WHERE sale_id = '".$this->sales_id."'";
        $this->db->query($query);
        $exists = $this->db->resultSet();
      

        return $exists;
    }
}