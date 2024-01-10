<?php
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");
   
    if($_SESSION['access_level'] != "Strategic"){
        header("location : /add-store-config.php");
    }
    $query = "SELECT * FROM companyinfo";
    $stmt = $conn->query($query);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count= $stmt->rowCount(); 
    
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Company Information Configuration</title>
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
        
         <?php 
        //header is implemented separately
        include("header-navigation.php");
        ?>
        
    
    <body>
        <section class = "container mx-auto">
        <div class = "row mx-0 px-0">
            <?php 
            //sidebar
            include("sidebar.php"); 
            ?>
        
            <main class = "col-lg-8 col-md-8 col-sm-12 col-xs-12 my-0 py-3 mx-auto px-auto ">
                <h3>Company Information</h3>
                <form id = "form" class = "form" action= "add-store-config.php"  method = "POST" enctype = "multipart/form-data">
                   <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Company Logo : </span>
                        <input type="file" id = "companyLogo" name = "companyLogo" class = "form-control "  required /></p>
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Company Name : </span>
                        <input id = "companyName" name = "companyName" for = "companyName" type = "text" class = "form-control " 
                         required 
                        placeholder = "<?php 
                        if($count = 1 ){
                            foreach($result as $row) {
                                echo $row['companyName'];
                            }
                        } ?>">
                        
                    </div>
                    <br>
                    <button type="submit" class = "btn btn-dark" name="Save" >Save</button>
                </form>
            </main>
        </div>
    </body>
    <footer class = "container mx-3">
        <p>Copyright  ©2022 Developed by May Phyu Sin Thant </p>
    </footer> 
</html>