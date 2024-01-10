<?php  
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");  
    
    $ID= $_GET['inventoryID'];  
    try {
        $sql = "DELETE FROM `inventory` WHERE inventoryID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$ID]);
        header("location: view-inventory-mgmt.php"); 
    }catch(PDOException $e){
        echo "Integirity Violation (This inventory record that you are attempting to delete is a 
        referenced key in other tables) . 
        Suggestion - Cannot delete this inventory record. Please clear all other related data to delete this record";
        echo "<br><a href = 'view-inventory-mgmt.php'>Go Back</a>";
    }
?>

