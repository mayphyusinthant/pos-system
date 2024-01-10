<?php
    ob_start();
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");
  
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Add Customer</title>
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
        <script type = "text/javascript" src="form-validation.js"></script> 

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
        
        <main class = "col-lg-4 col-md-4 col-sm-12 col-xs-12 my-0 py-3 mx-auto px-auto ">
            <h3>Add New Customer</h3>
            <?php if (isset($_GET['incorrect'])){ ?>
                <div class = "alert alert-warning text-center">
                    This customer information has been already recorded.
                </div>
            <?php  }  ?>
            <form id = "form" class = "form" method = "POST" >                
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text"> Customer Name : </span>
                        <input id = "customerName" name = "customerName" type = "text" class = "form-control " 
                        oninvalid="validateLetter(this);" oninput="validateLetter(this);" required >
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text"> Address: </span>
                        <input id = "address" name = "address" type = "text" class = "form-control " >
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Region : </span>
                        <input id = "region" name = "region" type = "text" class = "form-control "  >
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Phone : </span>
                        <input id = "phoneNo" name = "phoneNo" type = "text" class = "form-control "  >
                     </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Remark : </span>
                        <input id = "remark" name = "remark" type = "text" class = "form-control "  >
                    </div>
                    <br>
                    <a href = "view-customer-mgmt.php" type = "button" class = "btn btn-white"> Back </a>
                    <button type="submit" class = "btn btn-dark" name="Save" >Save</button>
                   
            </form>
        </main>
        </section>
    </body>
    <footer class = "container mx-3">
        <p>Copyright  ©2022 Developed by May Phyu Sin Thant </p>
    </footer> 
</html>
<?php

   try {

     if(isset($_POST["Save"])){
        $customerName = $_POST['customerName'];
        $address = htmlspecialchars($_POST['address']);
        $region = htmlspecialchars($_POST['region']);
        $phone = $_POST['phoneNo'];
        $remark = htmlspecialchars($_POST['remark']);

        $query = "SELECT * FROM `customer` WHERE customerName = ? AND `address` = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$customerName, $address]);
            
        $count= $stmt->rowCount();  
        //if customer has already existed, error message appears
         
        //When this customer info record does not exist, no integrity violation occurs. Can add current store no: and information.
        if($count != 1 ){
            $sql= "INSERT INTO `customer` (customerName,  `address`, region, phone, remark ) 
            VALUES ( ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$customerName, $address, $region, $phone, $remark]);  
            header('location: view-customer-mgmt.php');
        } 
       else { 
                header('location: add-customer.php?incorrect=1');
            }
        } 
    }catch(PDOException $e){
        echo "Invalid / Wrong User Input -. Please check inputs again";
   }
    
    ob_end_flush();
?>