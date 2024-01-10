<?php 
    ob_start();

    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");
    
        $ID = $_GET['customerID'];
        $NA = $_GET['customerName'];
        $add = $_GET['address'];
        $region = $_GET['region'];
        $ph = $_GET['phone'];
        $remark = $_GET['remark'];

        $result = "SELECT * FROM `customer` WHERE customerID = $ID";
        $stmt = $conn->query($result);
        
?>
<!doctype html> 
    <html> 
         <head>
        <title>Edit Customer Information</title>
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
            <h3>Edit Customer Information </h3>

            <form id = "form" class = "form" method = "POST" >                
                    <input type="hidden" name="customerID" value="<?php echo $ID ?>">

                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text"> Customer Name : </span>
                        <input id = "customerName" name = "customerName" value = "<?php echo $NA?>" 
                        type = "text" class = "form-control "  oninvalid="validateLetter(this);" oninput="validateLetter(this);"required >
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Address : </span>
                        <input id = "address" name = "address" value = "<?php echo $add?>"  type = "text" class = "form-control "  >
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Region : </span>
                        <input id = "region" name = "region" value = "<?php echo $region?>"  type = "text" class = "form-control "  >
                     </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Phone : </span>
                        <input id = "phone" name = "phone" value = "<?php echo $ph?>"  type = "text" class = "form-control "  >
                     </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Remark : </span>
                        <input id = "remark" name = "remark" value = "<?php echo $remark ?>" type = "text" class = "form-control "  >
                    </div>
                    <br>
                    <a href = "view-customer-mgmt.php" type = "button" class = "btn btn-white"> Back </a>
                    <button type="submit" class = "btn btn-dark" name="Save" >Update</button> 
            </form>
            
        </main>
        </section>
    </body> 
    <footer class = "container mx-3">
        <p>Copyright  ©2022 Developed by May Phyu Sin Thant </p>
    </footer> 

    <?php
      try {
        
        if(isset($_POST['Save'])) {
            $customerID = $_POST['customerID'];
            $customerName = $_POST['customerName'];
            $address = $_POST['address'];
            $region = $_POST['region'];
            $phone = $_POST['phone'];
            $remark = $_POST['remark'];

            $query = "SELECT * FROM `customer` WHERE customerName = ? AND `address` = ?";
            $stmt = $conn->prepare($query);
            $stmt->execute([$customerName, $address]);
                
            $count= $stmt->rowCount();  
            //if customer has already existed, error message appears
            
            //When this customer info record does not exist, no integrity violation occurs. Can add current store no: and information.
            if($count != 1 ){
                $sql = "UPDATE `customer` SET  customerName = ? ,  `address` = ?, 
                region = ?, phone = ? , remark = ? WHERE customerID = ? ";   
                $stmt = $conn->prepare($sql);
                $stmt->execute([ $customerName, $address, $region, $phone, $remark, $customerID]);
                
                header("location: view-customer-mgmt.php");
            }
            else { 
                echo "This customer information has been already recorded.";
                }
            } 
        }catch(PDOException $e){
            echo "Invalid / Wrong User Input . Please check again";
        }
    ob_end_flush();
?>