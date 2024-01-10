<?php
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");
 
?>

<!DOCTYPE html>

<html>
    <head>
        <title> Item Lists </title>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Author: May Phyu Sin Thant, PHP POS System for Clothing Store. Implemented in February, 2022">
        <link rel = "stylesheet" href = "css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    </head>
        <!--Required CDN: Bootstrap | Popper | Jquery to Work Boostrap Collapse Properly-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>  
                <script type = "text/javascript" src="form-validation.js"></script> 

         <?php 
        //header is implemented separately
        include("header-navigation.php");
        ?>
    </head>
      
    <style>
        .img-resposive {
            transition: transform .2s; /* Animation */
            margin: 0 auto;
        }

        .img-resposive:hover {
        transform: scale(5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        }
    </style>
    <body>
        <section class = "container mx-auto">
        <div class = "row mx-0 px-0 ">

            <?php include("sidebar.php"); ?>
        
            <main class = "col-lg-8 col-md-8 col-sm-12 col-xs-12 my-0 py-3 mx-0 px-0 ">
            
            <section class = "row mx-auto px-auto">
                <div class = "col ">
                    <h5>Total Items/Products (<?php  
                        $results = "SELECT COUNT(itemID) FROM `itemlist` ";
                        $count = $conn->query( $results); 
                        $number_of_rows = $count->fetchColumn(); 
                            echo $number_of_rows; 
                        ?>) 
                    </h5>
                    <table class= "table table-border table-hover">
                        <tr>
                            <th>Item ID </th>
                            <th>Item  </th>
                            <th>Category </th>
                            <th>Description </th>
                            <th>Photo</th>
                            <th>Action </th>
                        </tr> 
                        <?php 
                            $result = "SELECT * FROM `itemlist` ";
                            $rows = $conn->query($result);

                            error_reporting(0);
                            //echo 'testing 0';
                            if(isset($_POST['submitSearch'])) {
                                //echo 'testing';
                                $search = $_POST['search'];
                                //echo $search;
                                //echo $_POST['field'];
                                if($_POST['field'] == 'item'){
                                    $result = "SELECT * FROM itemlist WHERE itemName LIKE '%$search%' ";
                                   //echo "testing pass 1";
                                    
                                }if($_POST['field'] == 'category'){
                                    $result = "SELECT * FROM itemlist WHERE categoryName LIKE '%$search%' ";
                                    //echo "testing pass 1";  
                                }
                                $rows = $conn->query($result);  
                                //echo "testing pass 5";
                            }

                            foreach( $rows as $row ) {     
                        ?>
                        <tr>   
                            <td><?php echo $row['itemID']?></td>
                            <td><?php echo $row['itemName']?></td>
                            <td><?php echo $row['categoryName']?></td>
                            <td><?php echo $row['description']?></td>
                            <td><img class = "img-resposive img-thumbnail bg-image" alt = "product photo"
                            src = "imgs/<?php echo $row['image']?>"  width = "50" height = auto> </td>

                            <td>
                                <a href = "edit-item.php?itemID=<?php echo $row['itemID']?>
                                &itemName=<?php echo $row['itemName'] ?>
                                &categoryName=<?php echo $row['categoryName']?>
                                &description=<?php echo $row['description']?>" >
                            <i class="fas fa-edit"></i></a>
                            
                            <a href = "del-item.php?itemID=<?php echo $row['itemID']  ?>" 
                                class="del " onClick="return confirm('Are you sure to permanantly delete this inventory information ?')">
                                <i class="fas fa-times-circle fas "></i></a>
                            </td> 
                        </tr>
                    <?php } ?>
                    </table>
                </div> 
                <div class = "col mx-0 px-1" >
                <!--Search Items  -->
                <form id = "form " class = "form" method = "POST" >
                    <div class = "input-group mb-3 "> 
                        <input id = "search" name = "search" type = "text" class = "form-control " required placeholder = "Search Products ">
                   
                        <select id = "field" name = "field" class = "form-control " required>
                            <option value = "0"> --- Choose Field ↓ ---</option>
                            <option value="item"> Search By Item </option> 
                            <option value="category"> Search By Category </option>            
                        </select>                    
                        <button class="btn btn-outline-dark" type="submit" name = "submitSearch">Search</button>
                    </div>
                </form>
            

                    <h5>Add New Item </h5>
                    <form id = "form" class = "form" action = "add-item.php" method = "POST" enctype = "multipart/form-data">                

                            <div class = "input-group mb-3"> 
                                <span class = "input-group-text"> Item Name : </span>
                                <input id = "itemName" name = "itemName" type = "text" class = "form-control "
                                oninvalid="validateLetter(this);" oninput="validateLetter(this);"
                                 required >
                            </div>
                           
                            
                            <div class = "input-group mb-3">
                                <span class = "input-group-text"> Choose Category : </span>
                                    <select id = "categoryName1" name = "categoryName1" class = "form-control " required onchange='CheckCategory();'> 
                                    <option value = "0"> --- Choose Category ↓ ---</option>
                                    <?php 
                                        $result = "SELECT DISTINCT categoryName FROM itemlist";
                                        $stmt = $conn->query($result);                         
                                        foreach($stmt as $row ) {     
                                    ?>    
                                    <option value="<?php echo $row['categoryName'] ?>">      
                                        <?php echo $row['categoryName'] ?>    
                                    </option>   <?php } ?>
                                     <option value=" ">Add New Category</option> 
                                </select>  
                                <input type="text" name="categoryName" id="categoryNamebox" style='display:none;'/>             
                            </div>


                            <div class = "input-group mb-3"> 
                                <span class = "input-group-text">  Description : </span>
                                <input id = "description" name = "description" type = "text "  min="0" class = "form-control "  >
                            </div>
                            <div class = "input-group mb-3"> 
                                <span class = "input-group-text">  Image : </span>
                                <input type="file" id = "img" name = "img" class = "form-control " /></p>
                            </div>
                            <br>
                            <a href = "view-inventory-mgmt.php" type = "button" class = "btn btn-white"> Back </a>
                            <button type="submit" class = "btn btn-dark" name="Save"  >Save</button> 
                    </form>
                </div>
                </section>
            </main>
        </div>
    </body>
    <footer class = "container mx-3">
            <p>Copyright  ©2022 Developed by May Phyu Sin Thant </p>
    </footer> 
    <script>
         function CheckCategory(){
            var element = document.getElementById("categoryName1");
            var element2 = document.getElementById("categoryNamebox");
            if(element.value ==' '){
            element2.style.display='block';
            }
            else {
            element2.style.display='none';
            }
        }
    </script>
  