<?php  
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");  
    if($_SESSION['access_level']  != "Strategic"){
        header("location : /del-employee.php");
    }

    $ID= $_GET['employeeID'];  
    try {
        $sql = "DELETE FROM `employee` WHERE employeeID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$ID]);
        header("location: view-employee-mgmt.php"); 
    }catch(PDOException $e){
        echo "Integirity Violation (This Employee Account: that you are attempting to delete is a 
        referenced key in other tables) . Deleting this account will lead to occur a
        data inconsistency. 
        Suggestion - Instead of deleting this account, Set 'Inactive' in remark field. ";
        echo "<br><a href = 'view-employee-mgmt.php'>Go Back</a>";
    }
?>

