<?php  
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");
 
    $id = $_GET['inventoryID'];  
     $email = $_SESSION['email'];
   
    $result = "UPDATE inventory SET remark = remark + 1, instockqty = instockqty - 1, modifiedUser = '$email'
    WHERE inventoryID = $id ";
    $rows = $conn->query( $result); 

    header("location: view-inventory-mgmt.php"); 
?>