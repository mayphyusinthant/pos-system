<?php
    include("admin/conf/config.php");

?>
       

<!DOCTYPE html>

<html>
    <head>
        <title> </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    </head>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <!--Boostrap JS bundle-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
         
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Author: May Phyu Sin Thant, PHP POS System for Clothing Store. Implemented in February, 2022">

    <body>
        <!--header bar-->
        <nav class="navbar navbar-expand-lg  navbar-expand-md  bg-light sticky-top border" id = "sidebar-wrapper">
            <div class="container-fluid">
                 
                <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <a class="menu-toggle rounded" href="#"><i class="fas fa-bars"></i></a>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" href="dashboard.php"  aria-current="page" >
                            <?php if(isset($_SESSION['auth'])) {
                                  
                                $results = "SELECT * FROM `companyinfo` ";
                                $companyInfo = $conn->query( $results); 
                                foreach( $companyInfo as $row ) {
                                    $companyName = $row['companyName'];
                                    $logo = $row['logo'];
                                } ?>
                            <img src="imgs/<?php echo $row['logo'] ?>"  width="80" > 
                        </a>
                        <a class="nav-link" href="dashboard.php"  aria-current="page" style = "color : #072F5F; text-decoration: underline;"><b>POS System for Clothing Store</b></a>
                        <a class="nav-link" href="dashboard.php"  aria-current="page" style = "color : #072F5F;">
                            <b><?php
                               if(isset($row)) {
                                    echo $companyName;
                                }
                            }?></b>
                        </a>
                        <b><a class="nav-link" href="#" style = "color : black;"> 
                        <?php if(isset($_SESSION['auth'])) {
                                  
                                $email = $_SESSION['email'];
                                $results = "SELECT * FROM `employee` WHERE email = '$email' ";
                                $employeeInfo = $conn->query( $results); 
                                foreach( $employeeInfo as $row ) {
                                    $profile = $row['profileImage'];
                                    $name = $row['employeeName'];
                                    $level = $row['level']; 
                                    $store = $row['storeNo']; 
                                    $_SESSION['employee_assigned_store'] = $store;

                                } 
                                if(isset($row)) { ?>
                                   
                                <?php 
                                    echo $name.'  '.',';
                                    echo $level.' Level Admin';
                                    echo '  From Store No :'.$store;
                                } 
                            }?> </a> </b>
                        <a class = "nav-link" href = "view-profile.php"><i class="fad fa-id-card" style = "font-size: 22px;"></i></a> 

                       <a class = "nav-link" href = "logout.php"><i class="fas fa-sign-out-alt" style = "font-size: 22px;"></i></a> 
                    
                    </div>
                </div>
            </div>
        </nav>
    </body>
</html>

