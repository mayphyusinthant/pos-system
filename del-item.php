<?php  
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");
   
    $itemID= $_GET['itemID'];  
    try {
        $sql = "DELETE FROM `itemlist` WHERE itemID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$itemID]);
        header("location: item-lists.php"); 
    }catch(PDOException $e){
        echo "Integirity Violation (This item: that you are attempting to delete is a 
        referenced key in other tables) . 
        Suggestion - Cannot delete this item which has already been sold out for many times";
        echo "<br><a href = 'item-lists.php'>Go Back</a>";
    }
?>

