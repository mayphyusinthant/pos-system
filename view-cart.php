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
 
    $shoppingcart = 0;
    
    if(isset($_SESSION['shoppingcart'])){
        //session cart are stored in the cart var as product qty.
        foreach($_SESSION['shoppingcart'] as $qty){
            $shoppingcart += $qty;
        }
    }
    //if there is no product in cart, redirect to index.php
    if(!isset($_SESSION['shoppingcart'])){
      header("location: view-sale-mgmt.php");
       exit();
    }

    include("admin/conf/config.php");    

   
?>
<!doctype html>
<html>
    <head>
        <title> View Cart </title>
        <link rel = "stylesheet" href = "css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Author: May Phyu Sin Thant, POS System for Clothing Store. Implemented in February, 2022">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    </head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
         <!--Required CDN: Bootstrap | Popper | Jquery to Work Boostrap Collapse Properly-->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>   
       <?php 
        //header is implemented separately
        include("header-navigation.php");
        ?>
    </head>
    <body>
        
       <section class = "container mx-5">
            <div class = "row mx-0 px-0 ">
                <?php include("sidebar.php"); ?>
           
            <main class = "col-lg-9 col-md-9 col-sm-12 col-xs-12 my-0 py-3 mx-0 px-0 ">
                <section class = "row mx-0 px-0">
                
                <div class = "col mx-0 px-0" >
                    <table class= "table table-border card ">
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Tag Price</th>
                            <th>Discount</th>
                            <th>Actual Sale Price </th>
                            <th>Price</th>
                        </tr>
                        <?php 
                        $total = 0;
                        $employee_assigned_store = $_SESSION['employee_assigned_store'];
                        
                        foreach($_SESSION['shoppingcart'] as $id => $qty):
                            $result = "SELECT DISTINCT itemlist.itemName, inventory.discount, inventory.tagPrice 
                            FROM itemlist
                            RIGHt JOIN inventory
                            ON itemlist.itemID = inventory.itemID
                            WHERE inventory.itemID = '$id' AND
                            inventory.storeNo = $employee_assigned_store
                            ORDER BY inventory.purchasedDate ASC";

                            $rows = $conn->query($result);
                            foreach( $rows as $row ) :
                        ?>
                        <tr>
                            <td><?php echo $row['itemName']?></td>
                            <td>             
                            <input  onblur = "save(this)"  size = "2" step = "1" type = "number" min = "1" name = "qty" id="<?php echo $id?>" value = "<?php echo $qty ?>" >
                            <script>
                                function save(obj){
                                        
                                    var quantity = $(obj).val();
                                    var code = $(obj).attr("id");
                                    $.ajax({
                                        url: "update-cart-qty.php",
                                        type: "POST",
                                        data: 'code='+code+'&quantity='+quantity,
                                        success:function(data){}
                                    });
                                    setInterval('location.reload()', 50);
                                    }

                            
                                </script>
                            
                            </td>
                            <td><?php echo $row['tagPrice']?></td>
                            <td><?php echo $row['discount']?></td>

                            <td><?php 
                            //actualSalePrice means discounted Price
                            echo $acutalSalePrice = $row['tagPrice'] - ($row['tagPrice'] * $row['discount'] / 100)?> </td>
                            <td><?php echo $acutalSalePrice * $qty ?></td>
                            <?php $total += $acutalSalePrice * $qty ?>
                            
                            <td>
                                <a href = "del-cart-item.php?id=<?php echo $id ?>" >
                                <i class="fas fa-times-circle fas "></i></a>
                            </td>
                            
                        </tr>   
                        <?php 
                        endforeach; 
                        endforeach; ?>
                            
                        <tr>   
                            <td colspan ="3">Total (MMK):</td>
                            <td><?php 
                            echo  number_format($total, 2);?></td>
                        </tr>
                    </table>
                    <b><a href = "view-sale-mgmt.php"  style = "text-decoration:none;" >Back</a></b>
                    <b> | </b>
                    <b><a href = "clear-Cart.php"  style = "text-decoration:none;" > Clear Cart</a></b>
                    
                </div>
                
                <div class = "col mx-0 px-0" >
                
                    <form id="form" class="form form-control mx-0 "  method="post" >        
                    <hr><h6>Customer Information</h6>
                        
                    <div class="input-group mb-3">
                        <span class = "input-group-text">  Customer Name : </span>
                        <input   type="text" name="custName" id="custName" required 
                        placeholder = "Default: Retail Buyer" class = "form-control ">   
                    </div>

                    <div class="input-group mb-3">
                        <span class = "input-group-text">  Address : </span>    
                        <input type="text" name="address" id="address" class = "form-control "  
                        placeholder = "Optional"?> 
                    </div>

                    <div class="input-group mb-3">
                        <span class = "input-group-text">  Region : </span>       
                        <input type="text" name="region" id="region"   
                        class = "form-control " placeholder = "Optional"  ?> 
                    </div>

                    <div class="input-group mb-3">
                        <span class = "input-group-text">  Phone : </span>       
                        <input    type="text" name="phone" id="phone"  
                        class = "form-control " placeholder = "Optional" >   
                    </div>

                    <div class="input-group mb-3">
                        <span class = "input-group-text">  Remark : </span>       
                        <input  type = "text" name="remark" id="remark" 
                        class = "form-control " placeholder = "Optional">
                    </div>
                    <a href = "view-sale-mgmt.php" type = "button" class = "btn btn-white"> Back </a>
                    <button type="submit" class = "btn btn-dark" name="Save" >Check Out</button>
                </form>                   
                </div>
                </section>
            </main>
            </div>
        </section>
    </body>

    <footer>
        <p>Copyright  ©2022 Developed by May Phyu Sin Thant </p>          
    </footer> 
   
</html>
<?php 
        if(isset($_POST["Save"])){
            $custName = $_POST['custName'];
            $address = $_POST['address'];
            $region = $_POST['region'];
            $phone = $_POST['phone'];
            $remark = $_POST['remark'];
       
           foreach($_SESSION['shoppingcart'] as $id => $qty){
                $query = "SELECT inventory.itemID, instockqty, itemName, 
                storeNo FROM inventory 
                JOIN itemlist
                ON inventory.itemID = itemlist.itemID 
                WHERE inventory.itemID = '$id' AND storeNo = $employee_assigned_store";
                $result = $conn->query($query);

                foreach($result as $row){
                    if($qty > $row['instockqty']){ 
                        //echo $row['instockqty'];
                        echo '<script>alert("In stock quantity is insufficient" )</script>';
                        //break;
                    }else { 
                    $query = "SELECT * FROM `customer` WHERE customerName = ? AND `address` = ?";
                    $stmt = $conn->prepare($query);
                    $custInfo = $stmt->execute([$custName, $address]);
                        
                    $count= $stmt->rowCount();  
                
            
                //When this customer info record does not exist, no integrity violation occurs. Can add current store no: and information.
                    if($count != 1 ){
                        $sql= "INSERT INTO `customer` (customerName,  `address`, region, phone, remark ) 
                        VALUES ( ?, ?, ?, ?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute([$custName, $address, $region, $phone, $remark]);  
                        $customerID = $conn->lastInsertId();
                        
                    } 
                
                    else { 

                        echo 'custName :'.$custName;
                        $sql = "SELECT DISTINCT customerID FROM customer WHERE customerName = ? AND `address` = ?";
                        $sql = $conn->prepare($sql);
                        $sql->execute([$custName, $address]);
                        foreach( $sql as $row ) {
                            $sql = "UPDATE `customer` SET  customerName = ? ,  `address` = ?, 
                            region = ?, phone = ? , remark = ? WHERE customerID = ?";   
                            $stmt = $conn->prepare($sql);
                            $stmt->execute([ $custName, $address, $region, $phone, $remark, $row['customerID']]);
                            $customerID = $row['customerID'];
                            
                        }
                    }  
                    
                //insert row in saleInfo table
                    $result2 = "INSERT INTO saleinfo( customerID, storeNo, saleDate) 
                    VALUES  ( ?, ?, ? )";
                    $sql2 = $conn->prepare($result2);
                    $sql2->execute([$customerID, $employee_assigned_store, date("Y-m-d")]);   
                    $saleID = $conn->lastInsertId();
                    $_SESSION['custNo'] = $customerID;
                    $_SESSION['saleID'] = $saleID;
            
                 foreach($_SESSION['shoppingcart'] as $id => $qty){

                    $result4 = "INSERT INTO sales (saleID, itemID, qty, actualsalePrice) 
                    VALUES ( ?, ?, ?, ?) ";
                    $sql4 = $conn->prepare($result4); 
                    $sql4->execute([$saleID, $id,  $qty,  $acutalSalePrice]);  

                    $result3 = "SELECT DISTINCT itemID, instockqty
                    FROM inventory
                    WHERE inventory.itemID = $id AND storeNo = $employee_assigned_store
                    ORDER BY inventory.purchasedDate ASC ";

                    $rows = $conn->query($result3);
                    foreach( $rows as $row ) {
                            
                    $currentqty = $row['instockqty'];
                    //Update the instock quantity of item when check out process is done
                    $result5 = "UPDATE  `inventory` SET instockqty = ? WHERE itemID = ? && storeNo = ? ";
                    $updatedQty = $currentqty - $qty;
                    $sql5 = $conn->prepare($result5); 
                    $sql5->execute([$updatedQty, $id, $employee_assigned_store]);
                    } 
                    header('location: view-check-out-info.php');   
                } 
                    }
                }
            }
            
            }
    
         ?>
    <script >
               // Show input error message
               
    </script>

    <style>
        h6 {
            font-size: 14px;
            font-weight: bold;
            color: #c0392b;   
        }
    </style>

