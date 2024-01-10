<?php
  session_start();
  unset($_SESSION['firstName']);
  unset($_SESSION['lastName']); 
  ?>
 <?php header("location: index.php");?>

 
