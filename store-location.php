<?php
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");
    if($_SESSION['access_level']  != "Strategic"){
        header("location : /add-store-config.php");
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Store Location</title>
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
        <section class = "container mx-auto">
        <div class = "row mx-0 px-0 ">
        <?php 
        //sidebar
        include("sidebar.php"); ?>
        
        <main class = "col-lg-8 col-md-8 col-sm-12 col-xs-12 my-0 py-3 mx-auto px-auto ">
        
            <h3>Store Location (<?php  
            $results = "SELECT COUNT(storeNo) FROM `location` ";
                $count = $conn->query( $results); 
                $number_of_rows = $count->fetchColumn(); 
                    echo $number_of_rows; 
                ?>) 
            </h3>
            <a href = "add-location.php" type="button" class = "btn btn-dark"  >+ New Location</a>

           
            <table  class= "table table-border table-sm table-hover " > 
                <tr >
                    <th>Store No:</th>
                    <th>Address </th>
                    <th>Office Phone</th>
                    <th>Office Email </th>
                    <th>Store Manager</th>
                    <th>Action </th>
                </tr> 
                <?php 
                    $result = "SELECT * FROM `location`";
                    $rows = $conn->query($result);
                    foreach( $rows as $row ) :      
                ?>
                <tr>   
                    <td><?php echo 'Branch '.$row['storeNo']?></td>
                    <td><?php echo $row['address']?></td>
                    <td><?php echo $row['officePhone']?></td>
                    <td><?php echo $row['officeEmail']?></td>
                    <td><?php echo $row['storeManager']?></td>
                    <td>
                      
                       <a href = "edit-location.php?storeNo=<?php echo $row['storeNo']?>
                        &address=<?php echo $row['address'] ?>
                        &officePhone=<?php echo $row['officePhone']?>
                        &officeEmail=<?php echo $row['officeEmail']?>
                        &storeManager=<?php echo $row['storeManager']?>">
	                   <i class="fas fa-edit"></i></a>

                       <a href = "del-location.php?storeNo=<?php echo $row['storeNo']  ?>" 
                         class="del " onClick="return confirm('Are you sure?')">
	                    <i class="fas fa-times-circle fas "></i></a>
                    </td>
                    
                </tr>
            <?php endforeach; ?>
            </table> 
        </main>
    </body>
    <footer class = "container mx-3">
            <p>Copyright  ©2022 Developed by May Phyu Sin Thant </p>
    </footer> 