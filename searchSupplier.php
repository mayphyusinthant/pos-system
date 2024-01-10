<!DOCTYPE html>
<html lang="en">
<head>
<!--This file is linked to header-navigation.php-->
  <title>Search Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Author: May Phyu Sin Thant, Capital E-Commerce Website">

            <section class = "container row" >
                 <!--Search Suppliers -->
                <form id = "form " class = "form" action= "view-supplier-mgmt.php" method = "POST" >
                    <div class = "input-group mb-3 "> 
                        <a href = "add-supplier.php" type="button" class = "btn btn-dark "  >+ New Supplier</a>

                        <input id = "searchSup" name = "searchSup" type = "text" class = "form-control " required placeholder = "Search Suppliers">
                   
                        <select id = "fieldSup" name = "fieldSup" class = "form-control " required>
                            <option value = "0"> --- Choose Field ↓ ---</option>
                            <option value="supplierName"> Search By Name </option> 
                            <option value="address"> Search By Address </option> 
                            <option value="region"> Search By Region </option>            
                            <option value="modifiedDate"> Search By Modified Date </option>            
                        </select>                    
                        <button class="btn btn-outline-dark" type="submit">Search</button>
                    </div>
                </form>
            </section>

   <?php
     error_reporting(0);
            if(count($_POST)>0) {
                $searchSup = $_POST['searchSup'];
                //echo $searchSup;
                //echo $_POST['fieldSup'];
                if($_POST['fieldSup'] == 'supplierName'){
                    $result = "SELECT * FROM supplier WHERE supplierName LIKE '%$searchSup%' ";
                    //echo "testing pass 1";
                     
                }if($_POST['fieldSup'] == 'address'){
                    $result = "SELECT * FROM supplier WHERE `address` LIKE '%$searchSup%' ";  
                    //echo "testing pass 2"; 
                }if($_POST['fieldSup'] == 'region'){
                    $result = "SELECT * FROM supplier WHERE `region` LIKE '%$searchSup%' "; 
                    //echo "testing pass 3"; 
                }if($_POST['fieldSup'] == 'modifiedDate'){
                    $result = "SELECT * FROM supplier WHERE modifiedDate LIKE '%$searchSup%' "; 
                    //echo "testing pass 4";  
                }
                $rows = $conn->query($result);  
                //echo "testing pass 5";
            }
?>