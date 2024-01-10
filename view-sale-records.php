<?php
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");

   
?>

<!DOCTYPE html>

<html>
    <head>
        <title> Daily Sale Records Management</title>
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
           
            <h3>Today Daily Sale Records  (<?php 
                $today = date('Y-m-d');
                $results = "SELECT COUNT(saleID) FROM `saleinfo` WHERE saleDate = '$today'";
               
                $count = $conn->query( $results); 
                $number_of_rows = $count->fetchColumn(); 
                    echo $number_of_rows; 
                ?>) 
            </h3>
          
                <!--Search sale records -->
                <form id = "form " class = "form" method = "POST" >
                    <div class = "input-group mb-3 "> 

                        <input id = "search" name = "search" type = "text" class = "form-control " required placeholder = "Search Sale Records">
                        <select id = "field" name = "field" class = "form-control " required>
                            <option value = "0"> --- Choose Field ↓ ---</option>
                            <option value="date"> Search By Sale Date </option> 
                            <option value="storeNo"> Search By Store No: </option>            
                        </select>                    
                        <button class="btn btn-outline-dark" type="submit" name = "searchSubmit">Search</button>
                    </div>
                </form>

            <table class= "table table-border table-hover table-responsive-sm">
                <tr>
                    <th>Sale ID </th>
                    <th>Cust Name  </th>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Actual Sale Price </th>
                    <th>Store No: </th>
                    <th>Sale Date </th>
                </tr> 
                <?php 
                   $sql = "SELECT customer.customerName, saleinfo.* , sales.*, itemList.itemName
                    FROM saleinfo
                    LEFT JOIN customer 
                    ON customer.customerID = saleinfo.customerID
                    LEFT JOIN sales 
                    ON saleinfo.saleID = sales.saleID 
                    LEFT JOIN itemlist
                    ON itemlist.itemID = sales.itemID";
                    $rows = $conn->query($sql);

                    error_reporting(0);
                   
                        if(isset($_POST['searchSubmit'])) {
                            $search = $_POST['search'];
                            //echo $search;
                            //echo $_POST['field'];
                            if($_POST['field'] == 'date'){
                                $sql = "SELECT customer.customerName, saleinfo.* , sales.*, itemList.itemName
                                FROM saleinfo
                                LEFT JOIN customer 
                                ON customer.customerID = saleinfo.customerID
                                LEFT JOIN sales 
                                ON saleinfo.saleID = sales.saleID 
                                LEFT JOIN itemlist
                                ON itemlist.itemID = sales.itemID
                                WHERE saleinfo.saleDate LIKE '%$search%' ";
                                //echo "testing pass 1";
                                
                            }if($_POST['field'] == 'storeNo'){
                                $sql = "SELECT customer.customerName, saleinfo.* , sales.*, itemList.itemName
                                FROM saleinfo
                                LEFT JOIN customer 
                                ON customer.customerID = saleinfo.customerID
                                LEFT JOIN sales 
                                ON saleinfo.saleID = sales.saleID 
                                LEFT JOIN itemlist
                                ON itemlist.itemID = sales.itemID
                                WHERE saleInfo.storeNo LIKE '%$search%' ";  
                                //echo "testing pass 2"; 
                            }
                            $rows = $conn->query($sql);  
                            //echo "testing pass 5";
                        }
                    foreach( $rows as $row ) {     
                ?>
                <tr>   
                    <td><?php echo $row['saleID']?></td>
                    <td><?php echo $row['customerName']?></td>
                    <td><?php echo $row['itemName']?></td>
                    <td><?php echo $row['qty']?></td>
                    <td><?php echo $row['actualsalePrice']?></td>
                    <td><?php echo $row['storeNo']?></td>
                    <td><?php echo $row['saleDate'] ?> </td>
                   
                </tr>
            <?php } ?>
            </table>
        </main>
    </body>
    <footer class = "container mx-3">
            <p>Copyright  ©2022 Developed by May Phyu Sin Thant </p>
    </footer> 