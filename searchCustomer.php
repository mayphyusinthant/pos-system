<!DOCTYPE html>
<html lang="en">
<head>
<!--This file is linked to header-navigation.php-->
  <title>Search Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Author: May Phyu Sin Thant, Capital E-Commerce Website">

  <section class = "container row" >
                <!--Search Employees -->
                <form id = "form " class = "form" action= "view-customer-mgmt.php" method = "POST" >
                    <div class = "input-group mb-3 "> 
                        <a href = "add-customer.php" type="button" class = "btn btn-dark "  >+ New Customer</a>

                        <input id = "searchCust" name = "searchCust" type = "text" class = "form-control " required placeholder = "Search Customers">
                   
                        <select id = "fieldCust" name = "fieldCust" class = "form-control " required>
                            <option value = "0"> --- Choose Field ↓ ---</option>
                            <option value="customerName"> Search By Name </option> 
                            <option value="address"> Search By Address </option>            
                            <option value="region"> Search By Region </option>            
                        </select>                    
                        <button class="btn btn-outline-dark" type="submit">Search</button>
                    </div>
                </form>
            </section>

   <?php
     error_reporting(0);
            if(count($_POST)>0) {
                $searchCust = $_POST['searchCust'];
                //echo $searchEM;
                //echo $_POST['fieldEM'];
                if($_POST['fieldCust'] == 'customerName'){
                    $result = "SELECT * FROM customer WHERE customerName LIKE '%$searchCust%' ";
                    //echo "testing pass 1";
                     
                }if($_POST['fieldCust'] == 'address'){
                    $result = "SELECT * FROM customer WHERE `address` LIKE '%$searchCust%' ";  
                    //echo "testing pass 2"; 
                }if($_POST['fieldCust'] == 'level'){
                    $result = "SELECT * FROM region WHERE `region` LIKE '%$searchCust%' "; 
                    //echo "testing pass 3"; 
                }
                $rows = $conn->query($result);  
                //echo "testing pass 5";
            }
?>