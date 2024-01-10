<?php
    ob_start();
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");
    
    $employee_assigned_store = $_SESSION['employee_assigned_store'];
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Add New Inventory Record</title>
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
            <h3>Add New Inventory Record</h3>
            
            <form id = "form" class = "form" method = "POST" enctype = "multipart/form-data">                
                    <div class = "input-group mb-3">
                        <span class = "input-group-text"> Choose Item : </span>
                        <select id = "item" name = "item" class = "form-control " required>
                            <option value = "0"> --- Choose Item ↓ ---</option>
                            <?php 
                                $result = "SELECT DISTINCT itemID, itemName FROM itemlist";
                                $stmt = $conn->query($result);                         
                                foreach($stmt as $row ) {     
                            ?>    
                            <option value="<?php echo $row['itemID'] ?>">      
                                <?php echo $row['itemName'] ?>    
                            </option>    
                                <?php } ?> 
                        </select>
                        <a href = "item-lists.php" type = "button" class = "btn btn-dark"> + </a>

                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text"> Quantity : </span>
                        <input id = "qty" name = "qty" type = "number" min="0"  class = "form-control " required >
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Purchased Price : </span>
                        <input id = "purchasedPrice" name = "purchasedPrice" type = "number " min="0" class = "form-control "  >
                        <span class = "input-group-text"> MMK </span>
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text"> Discount : </span>
                        <input id = "discount" name = "discount" type = "number" min="0"  class = "form-control " required >
                        <span class = "input-group-text"> % </span>
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Tag Price : </span>
                        <input id = "tagPrice" name = "tagPrice" type = "text" class = "form-control "
                        oninvalid="validateNum(this);"
                        oninput="validateNum(this);"  required >
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
                         <input id = "storeNo" name = "storeNo" type = "number" class = "form-control" 
                         readonly value = "<?php echo $employee_assigned_store ?>" >
                   </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Remark : </span>
                        <input id = "remark" name = "remark" type = "text" class = "form-control "  >
                    </div>
                    
                    <br>
                    <a href = "view-inventory-mgmt.php" type = "button" class = "btn btn-white"> Back </a>
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
   if(isset($_POST["Save"])){
        $item = $_POST['item'];
        $qty = $_POST['qty'];
        $purchasePrice = $_POST['purchasedPrice'];
        $discount = $_POST['discount'];
        $tagPrice = $_POST['tagPrice'];
        $supplier = $_POST['supplier'];
        $storeNo = $_POST['storeNo'];
        $remark = htmlspecialchars($_POST['remark']);
   
        $query = "SELECT COUNT(*) FROM `inventory` WHERE itemID = $item && storeNo = $employee_assigned_store ";
        $result = $conn->query($query);
        
        $number_of_rows = $result->fetchColumn();
        //echo $employee_assigned_store; 
        //echo $number_of_rows;
        try {
            //echo "testing pass 0";                      
            //echo $item.'qty :'.$qty.'purchasePrice :'.$purchasePrice.'discount :'.$discount.'tagPrice :'.$tagPrice.'supplier :'.$supplier.'store No :'.$storeNo.'remark :'.$remark.'Date :'.date("Y-m-d").'user :'.$email;
        if($number_of_rows == 0 ){
                      
                $sql= "INSERT INTO `inventory` (itemID, instockqty, purchasePrice, discount, 
                tagPrice, supplierID, storeNo, remark, purchasedDate, modifiedUser) 
                VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$item, $qty, $purchasePrice, $discount, $tagPrice,
                $supplier, $storeNo, $remark, date("Y-m-d"), $email]); 
                //echo "testing pass 0"; 
                //echo $number_of_rows;   
                header('location: view-inventory-mgmt.php');
           
        }else {
            $query1 = "SELECT * FROM `inventory` WHERE itemID = $item && storeNo = $employee_assigned_store ";
            $result1 = $conn->query($query1);
            foreach( $result1 as $row ) {
                            
                $currentqty = $row['instockqty'];
                $updatedqty = $currentqty + $qty;

                $sql = "UPDATE `inventory` SET   `instockqty` = ?, 
                purchasePrice = ? , discount = ?, tagPrice = ?,  `supplierID` = ?,  storeNo = ? ,
                remark = ?, purchasedDate = ? , modifiedUser = ? WHERE itemID = ? ";   
                $stmt = $conn->prepare($sql);
                $stmt->execute([$updatedqty, $purchasePrice, $discount, $tagPrice,
                $supplier, $storeNo, $remark, date("Y-m-d"), $email, $item]);   
                //echo "testing pass 1"; 
                //echo $employee_assigned_store;
                //echo $number_of_rows;   

                header('location: view-inventory-mgmt.php');
            }
        }
    }catch(PDOException $e){
        echo "Invalid / Wrong User Input - Please check again";
       
    }
    }
    ob_end_flush();
?>