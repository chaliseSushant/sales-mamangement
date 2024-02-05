<?php

namespace app;

use database\Database;  
use app\Customers;  
use app\Products;  


class Sales {

    public $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function addSales($file){
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['file_json']['name']);
        $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

        // // Check if the file is a JSON file
        // if ($fileType !== 'json') {
        //     die("Error: Please upload a valid JSON file.");
        // }

        // // Move the uploaded file to a specific directory
        // if (move_uploaded_file($_FILES['file_json']['tmp_name'], $uploadFile)) {
        //     echo "File is valid, and was successfully uploaded.\n";

        //     // Read JSON file content
        //     $jsonContent = file_get_contents($uploadFile);
        //     $jsonData = json_decode($jsonContent, true);


        //     // Connect to the database
        //     $customers = new Customers();
        //     //$query = "INSERT INTO customers (customer_id, customer_name,customer_mail) VALUES (?, ?,?)"

        //     // Insert data into the database
           

        //     echo "Data successfully inserted into the database.";
        // } else {
        //     echo "Error uploading the file.";
        // }
    }
}