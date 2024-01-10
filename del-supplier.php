<?php  
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");  
 
    if($_SESSION['access_level']  == "Operational"){
        header("location : /del-supplier.php");
    }

    $ID= $_GET['supplierID'];  
    try {
        $sql = "DELETE FROM `supplier` WHERE supplierID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$ID]);
        header("location: view-supplier-mgmt.php"); 
    }catch(PDOException $e){
        echo "Integirity Violation (This Supplier Information: that you are attempting to delete is a 
        referenced key in other tables) . Deleting this information will lead to occur a
        data inconsistency. ";
        echo "<br><a href = 'view-supplier-mgmt.php'>Go Back</a>";
    }
?>

