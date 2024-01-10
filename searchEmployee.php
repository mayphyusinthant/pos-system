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
                <form id = "form " class = "form" action= "view-employee-mgmt.php" method = "POST" >
                    <div class = "input-group mb-3 "> 
                        <a href = "add-employee.php" type="button" class = "btn btn-dark "  >+ New Employee</a>

                        <input id = "searchEM" name = "searchEM" type = "text" class = "form-control "
                          required placeholder = "Search Employees">
                   
                        <select id = "fieldEM" name = "fieldEM" class = "form-control " required>
                            <option value = "0"> --- Choose Field ↓ ---</option>
                            <option value="employeeName"> Search By Name </option> 
                            <option value="position"> Search By Position </option>            
                            <option value="level"> Search By Level </option>            
                            <option value="storeNo"> Search By Store No: </option>            
                        </select>                    
                        <button class="btn btn-outline-dark" type="submit">Search</button>
                    </div>
                </form>
            </section>

   <?php
     error_reporting(0);
            if(count($_POST)>0) {
                $searchEM = $_POST['searchEM'];
                //echo $searchEM;
                //echo $_POST['fieldEM'];
                if($_POST['fieldEM'] == 'employeeName'){
                    $result = "SELECT * FROM employee WHERE employeeName LIKE '%$searchEM%' ";
                    //echo "testing pass 1";
                     
                }if($_POST['fieldEM'] == 'position'){
                    $result = "SELECT * FROM employee WHERE position LIKE '%$searchEM%' ";  
                    //echo "testing pass 2"; 
                }if($_POST['fieldEM'] == 'level'){
                    $result = "SELECT * FROM employee WHERE `level` LIKE '%$searchEM%' "; 
                    //echo "testing pass 3"; 
                }if($_POST['fieldEM'] == 'storeNo'){
                    $result = "SELECT * FROM employee WHERE storeNo LIKE '%$searchEM%' "; 
                    //echo "testing pass 4";  
                }
                $rows = $conn->query($result);  
                //echo "testing pass 5";
            }
?>