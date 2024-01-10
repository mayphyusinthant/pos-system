<?php
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");
 
?>

<!DOCTYPE html>

<html>
    <head>
        <title> Inventory Management</title>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Author: May Phyu Sin Thant, PHP POS System for Clothing Store. Implemented in February, 2022">
        <link rel = "stylesheet" href = "css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    </head>
        <!--Required CDN: Bootstrap | Popper | Jquery to Work Boostrap Collapse Properly-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>  
        
         <?php 
        //header is implemented separately
        include("header-navigation.php");
        ?>
    </head>
        
    <body>
        <section class = "container mx-3">
        <div class = "row mx-0 px-0 ">
        <?php 
        //sidebar
        include("sidebar.php"); ?>
        
        <main class = "col-lg-8 col-md-8 col-sm-12 col-xs-12 my-0 py-3 mx-auto px-auto ">
            
            <h3>These Items will be out of stock soon...  (<?php  
                $results = "SELECT COUNT(inventoryID) FROM `inventory` WHERE instockqty < 10 ";
                $count = $conn->query( $results); 
                $number_of_rows = $count->fetchColumn(); 
                    echo $number_of_rows; 
                ?>) 
            </h3>
            <a href = "view-inventory-mgmt.php" type = "button" class = "btn btn-dark">Back</a>

            <table class= "table table-border ">
                <tr>
                    <th>ID </th>
                    <th>Item  </th>
                    <th>Instock Qty</th>
                    <th>Purchased Price </th>
                    <th>Discount </th>
                    <th>Tag Price</th>
                    <th>Supplier ID </th>
                    <th>Store No: </th>
                     <th>Remark </th>
                    <th>Purchased Date </th>
                    <th>Modified User </th>
                </tr> 
                <?php 
                    $result = "SELECT inventory.* , itemlist.itemName FROM `inventory` 
                    JOIN itemlist
                    ON inventory.itemID = itemlist.itemID
                    WHERE inventory.instockqty < 10";
                    $rows = $conn->query($result);
                    foreach( $rows as $row ) :      
                ?>
                <tr>   
                    <td><?php echo $row['inventoryID']?></td>
                    <td><?php echo $row['itemName']?></td>
                    <td><?php echo $row['instockqty']?></td>
                    <td><?php echo $row['purchasePrice']?></td>
                    <td><?php echo $row['discount']?></td>
                    <td><?php echo $row['tagPrice']?></td>
                    <td><?php echo $row['supplierID']?></td>
                    <td><?php echo $row['storeNo']?></td>
                    <td><?php echo $row['remark']?></td>
                    <td><?php echo $row['purchasedDate']?></td>
                    <td><?php echo $row['modifiedUser']?></td>                  
                </tr>
            <?php endforeach; ?>
            </table>
        </main>
    </body>
    <footer class = "container mx-3">
            <p>Copyright  ©2022 Developed by May Phyu Sin Thant </p>
    </footer> 