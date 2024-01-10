<?php 
    ob_start();

    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");
    
   $employee_assigned_store = $_SESSION['employee_assigned_store'];
    $ID = $_GET['inventoryID'];
    $NA = $_GET['item'];
    $qty = $_GET['instockqty'];
    $purchase_price = $_GET['purchasePrice'];
    $disc = $_GET['discount'];
    $tag_price = $_GET['tagPrice'];
    $supplier = $_GET['supplierID'];
    $store_No = $_GET['storeNo'];
    $remark = $_GET['remark'];
    
    $result = "SELECT * FROM `inventory` WHERE inventoryID = $ID";
    $stmt = $conn->query($result);
        
?>
<!doctype html> 
    <html> 
         <head>
        <title>Edit Inventory Information</title>
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
            <h3>Edit Inventory Record </h3>
            
            <form id = "form" class = "form" method = "POST" >                
                    <input type="hidden" name="inventoryID" value="<?php echo $ID ?>">

                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text"> Quantity : </span>
                        <input id = "qty" name = "qty" type = "number" min="0"  placeholder = "<?php echo $qty ?>" class = "form-control " required >
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Purchased Price : </span>
                        <input id = "purchasePrice" name = "purchasePrice" type = "number " placeholder = "<?php echo $purchase_price ?>" min="0" class = "form-control "  >
                        <span class = "input-group-text"> MMK </span>
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text"> Discount : </span>
                        <input id = "discount" name = "discount" type = "number" min="0"  placeholder = "<?php echo $disc ?>" class = "form-control " required >
                        <span class = "input-group-text"> % </span>
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Tag Price : </span>
                        <input id = "tagPrice" name = "tagPrice" type = "text" 
                        placeholder = "<?php echo $tag_price ?>" class = "form-control " 
                        oninvalid="validateNum(this);"
                        oninput="validateNum(this);" required >
                        <span class = "input-group-text"> MMK </span> 
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Supplier : </span>
                        <select id = "supplier" name = "supplier" class = "form-control " required>
                            <option value = "0"> --- Choose Supplier ↓ ---</option>
                            <?php 
                                $result = "SELECT supplierID, supplierName FROM supplier";
                                $stmt = $conn->query($result);                         
                                foreach($stmt as $row ) {     
                            ?>    
                            <option value="<?php echo $row['supplierID'] ?>">      
                                <?php echo $row['supplierName'] ?>    
                            </option>    
                                <?php } ?> 
                        </select>
                        <a href = "add-supplier.php" type = "button" class = "btn btn-dark"> + </a>

                    </div>
                     <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Store No : </span>
                         <input id = "storeNo" name = "remark" type = "text" class = "form-control" 
                         value = "<?php echo $employee_assigned_store ?>" disabled>
                   </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Remark : </span>
                        <input id = "remark" name = "remark" type = "text" placeholder = "<?php echo $remark ?>" class = "form-control "  >
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Purchased Date: </span>
                        <input id = "purchasedDate" name = "purchasedDate" type = "text" placeholder = "Date Format - Y/M/D " class = "form-control " required >
                    </div>
                    
                    <br>
                    <a href = "view-inventory-mgmt.php" type = "button" class = "btn btn-white"> Back </a>
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
              
            $inventoryID = $_POST['inventoryID'];
           
            $qty = $_POST['qty'];
            $purchasePrice = $_POST['purchasePrice'];
            $discount = $_POST['discount'];
            $tagPrice = $_POST['tagPrice'];
            $supplierID = $_POST['supplier'];
            //$storeNo = $_POST['storeNo'];
            //echo $storeNo;
            $remark = $_POST['remark'];
            $purchasedeDate = $_POST['purchasedDate'];

            $sql = "UPDATE `inventory` SET  itemID = ? ,  `instockqty` = ?, 
            purchasePrice  = ? , discount = ?, tagPrice = ?,  `supplierID` = ?,  storeNo = ? ,
            remark = ? , purchasedDate = ? , modifiedUser = ? WHERE inventoryID = ? ";   
            $stmt = $conn->prepare($sql);
            $stmt->execute([ $NA, $qty, $purchasePrice, $discount,
            $tagPrice, $supplierID, $employee_assigned_store, $remark,  $purchasedeDate,  $_SESSION['email'] , $inventoryID,]);
            
            header("location: view-inventory-mgmt.php");
        }
    }catch(PDOException $e){
        echo "Invalid / Wrong User Input . Please check again";
    }
         ob_end_flush();

?>