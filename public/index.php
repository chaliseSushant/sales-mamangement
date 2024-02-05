<?php
    include './app/Sales.php';
    $sales = new Sales();
    echo "this is it";
    //var_dump($sales);
    if($_SERVER['REQUEST_METHOD' == 'POST']){
        
         $addSales = $sales->addSales($_FILES);
     }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css"/>
    <title>Sales Management</title>
</head>
<body>
    <div class="main-container">
        <div class="container">
            <div class="form-section">
                <form  method="POST" enctype="multipart/form-data" class="file-import-form" >
                        <input type="file" class="file_input" name="file_json">
                        <button class="btn_import" >Import</button>
                </form>
                <form action="" class="filter-form"> 
                    <div class="custom-input">
                        <input class="search_input" type="text" name="search_term" placeholder="Enter Search term here">
                    </div>
                    <button class= "btn-search"type="submit">Search</button>
                </form>
                
            </div>
            <div class="sales-table">
                <table class="sales-table">
                    <thead>
                        <tr>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
<style>



</style>