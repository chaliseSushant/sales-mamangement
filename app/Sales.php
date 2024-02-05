<?php

include 'Database.php';


class Sales {

    public $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function addSales($file){
        // var_dump($file);
        // $uploadDir = 'uploads/';
        // $uploadFile = $uploadDir . basename($_FILES['file_json']['name']);
        // $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
        $fileName = $file['file_json']['name'];
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $tmpName = $file['file_json']['tmp_name'];
        // Check if the file is a JSON file
        if ($fileType !== 'json') {
            die("Error: Please upload a valid JSON file.");
        }
        // Read JSON file content
        $jsonContent = file_get_contents($tmpName);
        // Move the uploaded file to a specific directory
       // Decode JSON data
       $salesData = json_decode($jsonContent, true);
       $customers = [];
       foreach($salesData as $data){
            array_push($customers, $data['customer_name'], $data['customer_email']);
            
       }
        
       var_dump($data);
    }
}