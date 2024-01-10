<?php  
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php"); 
    
    $ID= $_GET['customerID'];  
    try {
        $sql = "DELETE FROM `customer` WHERE customerID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$ID]);
        header("location: view-customer-mgmt.php"); 
    }catch(PDOException $e){
        echo "Integirity Violation (This Customer Account: that you are attempting to delete is a 
        referenced key in other tables) . Deleting this account will lead to occur a
        data inconsistency. 
        <br><a href = 'view-customer-mgmt.php'>Go Back</a>";
    }
?>

