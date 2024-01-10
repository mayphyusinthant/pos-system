<?php
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");
?>

<!DOCTYPE html>

<html>
    <head>
        <title> Customer Information Management</title>
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
           
            <h3>Customers  (<?php 
                $results = "SELECT COUNT(customerID) FROM `customer` ";
                $count = $conn->query( $results); 
                $number_of_rows = $count->fetchColumn(); 
                    echo $number_of_rows; 
                ?>) 
            </h3>

            <table class= "table table-border table-hover table-responsive-sm">
                <tr>
                    <th>ID </th>
                    <th>Customer Name  </th>
                    <th>Address</th>
                    <th>Region </th>
                    <th>Phone </th>
                    <th>Remark </th>
                    <th>Action </th>
                </tr> 
                <?php 
                    $result = "SELECT * FROM `customer`";
                    $rows = $conn->query($result);
                    include("searchCustomer.php");
                    foreach( $rows as $row ) {      
                ?>
                <tr>   
                    <td><?php echo $row['customerID']?></td>
                    <td><?php echo $row['customerName']?></td>
                    <td><?php echo $row['address']?></td>
                    <td><?php echo $row['region']?></td>
                    <td><?php echo $row['phone']?></td>
                    <td><?php echo $row['remark']?></td>
  
                    <td>
                        <a href = "edit-customer.php?customerID=<?php echo $row['customerID']?>
                        &customerName=<?php echo $row['customerName'] ?>
                        &address=<?php echo $row['address']?>
                        &region=<?php echo $row['region']?>
                        &phone=<?php echo $row['phone']?>
                        &remark=<?php echo $row['remark']?>" >
	                   <i class="fas fa-edit"></i></a>
                       
                       <a href = "del-customer.php?customerID=<?php echo $row['customerID']  ?>" 
                         class="del " onClick="return confirm('Are you sure to permanantly delete this customer account ?')">
	                    <i class="fas fa-times-circle fas "></i></a>
                    </td> 
                    
                </tr>
            <?php } ?>
            </table>
        </main>
    </body>
    <footer class = "container mx-3">
            <p>Copyright  ©2022 Developed by May Phyu Sin Thant </p>
    </footer> 