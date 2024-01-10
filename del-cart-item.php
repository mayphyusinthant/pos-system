<?php
	session_start();
	include("admin/conf/auth.php"); 
    include("admin/conf/config.php");
 
	
	$id = $_GET['id']; //get product item to be deleted from cart
	unset($_SESSION['shoppingcart'][$id]);
	
    header("location:view-cart.php");
?>