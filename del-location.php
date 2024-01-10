<?php  
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");  
    if($_SESSION['access_level']  != "Strategic"){
        header("location : /del-location.php");
    }
    $storeNo= $_GET['storeNo'];  
    try {
        $sql = "DELETE FROM `location` WHERE storeNo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$storeNo]);
        header("location: store-location.php"); 
    }catch(PDOException $e){
        echo "Integirity Violation (This Store No: that you are attempting to delete is a 
        referenced key in other tables) . 
        Suggestion - To delete this store branch, all others related informations - sales and
        inventory records of this store needed to be deleted too which will leads to occur a
        data inconsistency.";
        echo "<br><a href = 'store-location.php'>Go Back</a>";
    }
?>

