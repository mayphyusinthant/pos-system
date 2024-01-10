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
                <form id = "form " class = "form" action= "view-inventory-mgmt.php" method = "POST" >
                    <div class = "input-group mb-3 "> 

                        <input id = "search" name = "search" type = "text" class = "form-control " required placeholder = "Search Records">
                   
                        <select id = "field" name = "field" class = "form-control " required>
                            <option value = "0"> --- Choose Field ↓ ---</option>
                            <option value="item"> Search By Item Name </option> 
                            <option value="cat"> Search By Category </option>            
                            <option value="store"> Search By Store No: </option>    
                            <option value="supplier"> Search By Supplier Name: </option>  
                            <option value="date"> Search By Date: </option>                    
                        </select>                    
                        <button class="btn btn-outline-dark" type="submit">Search</button>
                    </div>
                </form>
            </section>

   <?php
     error_reporting(0);
            if(count($_POST)>0) {
                $search = $_POST['search'];
                //echo $searchEM;
                //echo $_POST['fieldEM'];
                if($_POST['field'] == 'item'){
                    $result = "SELECT inventory.*, itemlist.itemName, supplier.supplierName FROM `inventory`
                    LEFT JOIN itemlist
                    ON inventory.itemID = itemlist.itemID
                    LEFT JOIN supplier
                    ON inventory.supplierID = supplier.supplierID
                    WHERE itemlist.itemName LIKE '%$search%' 
                    ORDER BY purchasedDate ASC ";
                    //echo "testing pass 1";
                     
                }if($_POST['field'] == 'cat'){
                    $result = "SELECT inventory.*, itemlist.itemName, supplier.supplierName FROM `inventory`
                    LEFT JOIN itemlist
                    ON inventory.itemID = itemlist.itemID
                    LEFT JOIN supplier
                    ON inventory.supplierID = supplier.supplierID
                    WHERE itemlist.categoryName LIKE '%$search%'
                    ORDER BY purchasedDate ASC  ";  
                    //echo "testing pass 2"; 
                }if($_POST['field'] == 'store'){
                    $result = "SELECT inventory.*, itemlist.itemName, supplier.supplierName FROM `inventory`
                    LEFT JOIN itemlist
                    ON inventory.itemID = itemlist.itemID
                    LEFT JOIN supplier
                    ON inventory.supplierID = supplier.supplierID
                    WHERE inventory.`storeNo` LIKE '%$search%' 
                    ORDER BY purchasedDate ASC "; 
                    //echo "testing pass 3"; 
                }if($_POST['field'] == 'supplier'){
                    $result = "SELECT inventory.*, itemlist.itemName, supplier.supplierName FROM `inventory`
                    LEFT JOIN itemlist
                    ON inventory.itemID = itemlist.itemID
                    LEFT JOIN supplier
                    ON inventory.supplierID = supplier.supplierID
                    WHERE supplier.supplierName LIKE '%$search%' 
                    ORDER BY purchasedDate ASC "; 
                    //echo "testing pass 3"; 
                }if($_POST['field'] == 'date'){
                    $result = "SELECT inventory.*, itemlist.itemName, supplier.supplierName FROM `inventory`
                    LEFT JOIN itemlist
                    ON inventory.itemID = itemlist.itemID
                    LEFT JOIN supplier
                    ON inventory.supplierID = supplier.supplierID
                    WHERE inventory.`purchasedDate` LIKE '%$search%' 
                    ORDER BY purchasedDate ASC "; 
                    //echo "testing pass 3"; 
                }
                $rows = $conn->query($result);  
                //echo "testing pass 5";
            }
?>