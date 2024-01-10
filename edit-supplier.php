<?php 
    ob_start();
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");
    if($_SESSION['access_level']  == "Operational"){
        header("location : /edit-supplier.php");
    }

    $ID = $_GET['supplierID'];
    $NA = $_GET['supplierName'];
    $add = $_GET['address'];
    $reg = $_GET['region'];
    $ph = $_GET['phone'];
    $mail = $_GET['email'];

    $result = "SELECT * FROM `supplier` WHERE supplierID = $ID";
    $stmt = $conn->query($result);
        
?>
<!doctype html> 
    <html> 
         <head>
        <title>Edit Supplier Information</title>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Author: May Phyu Sin Thant, PHP POS System for Clothing Store. Implemented in February, 2022">
        <link rel = "stylesheet" href = "css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    </head>
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
            <h3>Edit Supplier Information </h3>
            <?php if (isset($_GET['incorrect'])){ ?>
                <div class = "alert alert-warning text-center">
                    This Supplier Name has been existed. 
                </div>
            <?php  }  ?>
            <form id = "form" class = "form" method = "POST" enctype = "multipart/form-data">                
                    <input type="hidden" name="supplieriD" value="<?php echo $ID ?>">

                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text"> Supplier Name : </span>
                        <input id = "supplierName" name = "supplierName" value = "<?php echo $NA?>" 
                        type = "text" class = "form-control " 
                        oninvalid="validateLetter(this);"
                        oninput="validateLetter(this);" required >
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Address : </span>
                        <input id = "address" name = "address" value = "<?php echo $add?>"  type = "text" class = "form-control "  >
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Region : </span>
                        <input id = "region" name = "region" value = "<?php echo $reg?>"  
                        type = "text" class = "form-control " oninvalid="validateLetter(this);"
                        oninput="validateLetter(this);" >
                     </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Phone : </span>
                        <input id = "phone" name = "phone" value = "<?php echo $ph?>"  type = "text" 
                        class = "form-control " oninvalid="validateNum(this);"
                        oninput="validateNum(this);" >
                     </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Email : </span>
                        <input id = "email" name = "email" value = "<?php echo $mail?>"  type = "text" class = "form-control "  >
                    </div>
                    
                    <br>
                    <a href = "view-supplier-mgmt.php" type = "button" class = "btn btn-white"> Back </a>
                    <button type="submit" class = "btn btn-dark" name="Save" >Update</button>
                   
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
          if(isset($_POST['Save'])) {
            $supplierName = $_POST['supplierName'];
            $address = $_POST['address'];
            $region = $_POST['region'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];

            
            $sql = "UPDATE `supplier` SET  supplierName = ? ,  `address` = ?, `region` = ?,
            phone = ? , email = ? WHERE supplierID  = ? ";   
            $stmt = $conn->prepare($sql);
            $stmt->execute([$supplierName, $address, $region, $phone, $email, $ID]);
            
            header("location: view-supplier-mgmt.php");
        }
    }catch(PDOException $e){
        echo "Invalid / Wrong User Input - Supplier Name or Email might have beeen 
        registered by other supplier. Please check again
        <br><a href = 'view-supplier-mgmt.php'>Go Back</a>";       
    }
         ob_end_flush();

?>