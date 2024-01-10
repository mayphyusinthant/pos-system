<?php  
    session_start(); 
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");
 
    //unset function is used to delete session data
    unset($_SESSION['shoppingcart']);  
    header("location: view-sale-mgmt.php");   
?>