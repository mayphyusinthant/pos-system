<?php 
    //session_start(); 
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");   
    unset($_SESSION['shoppingcart']);  
?>


<!doctype html>
<html>
    <head>
        <title> Check Out Info </title>
        <link rel = "stylesheet" href = "css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Author: May Phyu Sin Thant, POS System for Clothing Store. Implemented in February, 2022">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    </head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
         <!--Required CDN: Bootstrap | Popper | Jquery to Work Boostrap Collapse Properly-->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>   
       
    </head>
    <body>
       <section class = "container mt-5 mx-5 col-lg-4 col-md-4 col-sm-10 col-xs-8" >
            <div class = "row mx-0 px-0 ">
                    <table class= "table table-border card ">
                        <tr>
                             <td><?php echo '<b>Date of Sale : </b>'.date("Y-m-d"); ?></td>
                              <td><?php echo '<b>Store No : </b>'.$_SESSION['employee_assigned_store'] ?></td>
                        </tr>
                        <tr>
                            <?php //echo $_SESSION['custNo']; ?>
                            <?php //echo $_SESSION['saleID']; ?>
                            <?php
                                $sql1 = "SELECT * FROM customer WHERE customerID = ?";
                                $sql1 = $conn->prepare($sql1);
                                $sql1->execute([$_SESSION['custNo']]);
                                foreach( $sql1 as $row1 ) { ?>
                            <td><?php echo '<b>Customer : </b>'.$row1['customerName'];?></td>
                            <td><?php echo '<b>Address : </b>'.$row1['address'].$row1['region']; ?></td>
                            <td><?php echo '<b>Phone : </b>'.$row1['phone']; }?></td>
                        </tr>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Actual Sale Price </th>
                            <th>Sub Total</th>
                        </tr>  
                         <?php
                         $total = null;
                                $sql2 = "SELECT saleInfo.*, sales.* , itemlist.itemName FROM sales
                                RIGHT JOIN saleinfo
                                ON saleinfo.saleID = sales.saleID
                                JOIN itemlist
                                ON sales.itemID = itemlist.itemID
                                WHERE saleInfo.saleID =  ?";
                                $sql2 = $conn->prepare($sql2);
                                $sql2->execute([$_SESSION['saleID']]);
                                foreach( $sql2 as $row2 ) { ?>
                        
                        <tr>
                            <td><?php echo $row2['itemName'];?></td>
                            <td><?php echo $row2['qty'];?></td>
                            <td><?php echo $row2['actualsalePrice'];?></td>
                            <td><?php echo $row2['qty'] * $row2['actualsalePrice']; 
                            
                            $total += $row2['qty'] * $row2['actualsalePrice'] ;
                            } ?> </td>
                        </tr> 
                        <tr>
                            <th colspan = "3"> Total </th>
                            <td> <?php echo $total ; ?> </td>
                        </tr>
                        <tr>
                            <td><a href = "view-sale-mgmt.php" class = "btn btn-dark" type = "button"> Back </a></td>
                            <td><button  class = "btn btn-dark"  onclick="window.print()" <?php  unset($_SESSION['custNo']); unset($_SESSION['saleID']);?>>Print </button></td>
                        </tr>
                    </table>
            </div>
               <footer>
                    <p>Copyright  ©2022 Developed by May Phyu Sin Thant </p>          
                </footer> 
        </section>
    </body>

 
   