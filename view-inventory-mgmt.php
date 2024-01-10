<?php
ob_start();
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");
 //if session auth is not set, redirect to login page
    if(!isset($_SESSION['auth'])){
        header("location: index.php");
        exit();
    }else {
        $email = $_SESSION['email'];
        $employee_assigned_store = $_SESSION['employee_assigned_store'];
    }
 
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
            
            <h3>Total Records  (<?php  
                $results = "SELECT COUNT(inventoryID) FROM `inventory` ";
                $count = $conn->query( $results); 
                $number_of_rows = $count->fetchColumn(); 
                    echo $number_of_rows; 
                ?>) 
                <a href = "out-of-stock-item.php" alt ="link"><i class="fa fa-bell" aria-hidden="true">
                    <span class = "badge bg-danger rounded-pill translate-middle"> 
                        <?php 
                            $results = "SELECT COUNT(inventoryID) FROM `inventory` WHERE instockqty < 10 ";
                            $count = $conn->query( $results); 
                            $number_of_rows = $count->fetchColumn(); 
                                echo $number_of_rows; 
                            ?>
                    </i></span>
                </a>
            </h3>
            <div class = "row">
                <div class = "col-lg-8 col-md-8 col-sm-12 col-xs-12 alert alert-warning">
                    Notice: Employees can edit and delete inventory records only from the
                    store branch they works. They are not allowed to edit or delete inventory records
                    from other store branches.
                </div>
                <div class = "col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <a href = "add-inventory-record.php" type="button" class = "btn btn-dark my-3"  >+ Add New Record</a>
                    <a href = "item-lists.php" type="button" class = "btn btn-dark mb-3"  > Available Items/Products Lists</a>
                </div>
            </div>
            <table class= "table table-border table-hover table-responsive-sm">
                <tr>
                    <th>ID </th>
                    <th>Item  </th>
                    <th>Instock Qty</th>
                    <th>Purchased Price </th>
                    <th>Discount </th>
                    <th>Tag Price</th>
                    <th>Supplier  </th>
                    <th>Store No: </th>
                     <th>Remark </th>
                    <th>Purchased Date </th>
                    <th>Modified User </th>
                    <th> Action </th>
                </tr> 
                <?php 
                    $result1 = "SELECT inventory.*, itemlist.itemName, supplier.supplierName FROM `inventory`
                    LEFT JOIN itemlist
                    ON inventory.itemID = itemlist.itemID
                    LEFT JOIN supplier
                    ON inventory.supplierID = supplier.supplierID
                    ORDER BY purchasedDate ASC ";
                    $rows = $conn->query($result1);
                    include("searchInventory.php");
                    foreach( $rows as $row ) {      
                ?>
                    <tr><td><?php echo $row['inventoryID']?></td>
                    <td><?php echo $row['itemName'] ?></td>
                    <td><?php echo $row['instockqty']?></td>
                    <td><?php echo $row['purchasePrice']?></td>
                    <td><?php echo $row['discount']?></td>
                    <td><?php echo $row['tagPrice']?></td>
                    <td><?php echo $row['supplierName'] ?></td>
                    <td><?php echo $row['storeNo']?></td>
                    <td>
                         <a href = "damage-item.php?inventoryID=<?php echo $row['inventoryID']  ?>" 
                         class="del btn btn-dark" onClick="return confirm('Reduce 1 Item from Inventory In Stock ')" type = "button">
	                    Damaged<?php echo $row['remark'] ?></a>
                    </td>
                    <td><?php echo $row['purchasedDate']?></td>
                    <td><?php echo $row['modifiedUser']?></td>
                    
                    <td>
                        <?php
                        //if employee work place 'store No:' does not same with inventory item 'store No:', 
                        //he cannot edit that record. Only assigned workers from that store No: can change
                        // inventory records in their related store branches
                        if($employee_assigned_store == $row['storeNo']) {  ?>
                            <a href = "edit-inventory-record.php?inventoryID=<?php echo $row['inventoryID']?>
                            &item=<?php echo $row['itemID'] ?>
                            &instockqty=<?php echo $row['instockqty'] ?>
                            &purchasePrice=<?php echo $row['purchasePrice']?>
                            &discount=<?php echo $row['discount']?>
                            &tagPrice=<?php echo $row['tagPrice']?>
                            &supplierID=<?php echo $row['supplierID']?> 
                            &storeNo=<?php echo $row['storeNo']?>
                            &remark=<?php echo $row['remark']?>" >
                        <i class="fas fa-edit"></i></a>
                       
                       <a href = "del-inventory-record.php?inventoryID=<?php echo $row['inventoryID']  ?>" 
                         class="del " onClick="return confirm('Are you sure to permanantly delete this inventory information ?')">
	                    <i class="fas fa-times-circle fas "></i></a>

                        <?php } else { ?>
                            <i class="fas fa-info-circle">Cannot Edit or Del</i>                        
                        <?php  } ?>
                    </td> 
                  
                </tr>
            <?php }; 
                //delete records from inventory table when instock gone
                $result4 = "DELETE inventory.* FROM inventory where instockqty = 0";
                $conn->query($result4);
            
            ?>
            </table>
             <?php   ob_end_flush();?>
        </main>
    </body>
    <footer class = "container mx-3">
            <p>Copyright  ©2022 Developed by May Phyu Sin Thant </p>
    </footer> 