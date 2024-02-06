<?php

    include_once('./app/Sales.php');
    $sales = new Sales();
    $total = 0;
    //if request method is post , send file to read the data
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $sales->addSales();
     }
     //get sales data
    $salesData = $sales->getSales();
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./public/styles.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
                        <input class="search_input" type="text" method="GET" name="search_term" placeholder="Enter Search term here">
                    </div>
                    <button class= "btn-search"type="submit">Search</button>
                </form>
                
            </div>
            <div class="sales-table">
                <table class="sales-table">
                    <thead>
                        <tr>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($salesData as $sales):
                            $total += $sales['price'];
                        ?>
                        <tr>
                            <td><?php echo $sales['sales_date'];?></td>
                            <td><?php echo $sales['customer'];?></td>
                            <td><?php echo $sales['email'];?></td>
                            <td><?php echo $sales['product'];?></td>
                            <td><?php echo $sales['price'];?></td>
                        </tr>
                        <?php endforeach?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Total:</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?php echo $total;?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
