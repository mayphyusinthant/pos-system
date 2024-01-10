<?php
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");
    
    $results = "SELECT level FROM `employee` WHERE email = '$email'" ;
    $sql = $conn->query( $results); 
    foreach( $sql as $row ) {
        $accessLevel = $row['level'];
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Dashboard</title>
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
        
    <body >
     
       <section class = "container mx-auto">
        <div class = "row mx-0 px-0 ">
        <?php 
        //sidebar
        include("sidebar.php"); ?>
        
        <main class = "col-lg-8 col-md-8 col-sm-12 col-xs-12 my-0 py-3 mx-auto px-auto ">
            <div class = "row mx-auto">
                 <?php 
                //only STRATEGIC level employee accounts can access into Company & Multi-Store CONFIGURATION 
                // and employee account management
                if($accessLevel != "Strategic"){ ?>

                    <div class = "col-lg-3 col-md-3  col-sm-5 col-xs-4 card mb-2 pb-2">
                        <b class = "card-header">Configure Company Info</b>
                        <p class = "card-body">Set Company Name & Logo</p>
                        <a href = "#" type="button " class="btn btn-dark disabled" disabled >Go >></a>
                    </div>
                    <div class = "col-lg-3 col-md-3  col-sm-5 col-xs-5 card mb-2 pb-2">
                        <b class = "card-header">Configure Store Location</b>
                        <p class = "card-body">Set  Store Branches - Store No:, Addresses, Office Phone, Email and Manager in All Branches</p>
                        <a href = "#" type="button " class="btn btn-dark disabled" disabled >Go >></a>
                    </div>
                     <div class = "col-lg-3 col-md-3 col-sm-5 col-xs-5 card mb-2 pb-2">
                        <b class = "card-header">Employee Accounts Management</b>
                        <p class = "card-body">Create New Accounts, Edit & Delete Existing Accounts Information, Search  Informations by Desired Fields</p>
                        <a href = "#" type="button " class="btn btn-dark disabled" disabled >Go >></a>
                     </div>

                    <?php } else { ?>
                        <div class = "col-lg-3 col-md-3  col-sm-5 col-xs-4 card mb-2 pb-2">
                        <b class = "card-header">Configure Company Info</b>
                        <p class = "card-body">Set Company Name & Logo</p>
                        <a href = "company-info-config.php" type="button" class="btn btn-dark " >Go >></a>
                    </div>
                    <div class = "col-lg-3 col-md-3  col-sm-5 col-xs-5 card mb-2 pb-2">
                        <b class = "card-header">Configure Store Location</b>
                        <p class = "card-body">Set  Store Branches - Store No:, Addresses, Office Phone, Email and Manager in All Branches</p>
                        <a href = "store-location.php" type="button" class="btn btn-dark" >Go >></a>
                    </div>
                    <div class = "col-lg-3 col-md-3 col-sm-5 col-xs-5 card mb-2 pb-2">
                        <b class = "card-header">Employee Accounts Management</b>
                        <p class = "card-body">Create New Accounts, Edit & Delete Existing Accounts Information, Search  Informations by Desired Fields</p>
                        <a href = "view-employee-mgmt.php" type="button" class="btn btn-dark" >Go >></a>
                    </div>
                <?php }

                //only STRATEGIC and Tactical level employee accounts can access into Supplier Mgmt...
                if($accessLevel != "Operational"){ ?>
                    

                    <div class = "col-lg-3 col-md-3 col-sm-5 col-xs-5 card mb-2 pb-2">
                        <b class = "card-header">Supplier Information Management</b>
                        <p class = "card-body">Record, Edit & Delete Suppliers Information, Search  Informations by Desired Fields</p>
                        <a href = "view-supplier-mgmt.php" type="button" class="btn btn-dark" >Go >></a>
                    </div>
                
                <?php } else { ?>
                   
                     <div class = "col-lg-3 col-md-3 col-sm-5 col-xs-5 card mb-2 pb-2">
                        <b class = "card-header">Supplier Information Management</b>
                        <p class = "card-body">Create New Accounts, Edit & Delete Existing Accounts Information, Search  Informations by Desired Fields</p>
                        <a href = "#" type="button " class="btn btn-dark disabled" disabled >Go >></a>
                     </div>
                <?php } ?>
               
                 <div class = "col-lg-3 col-md-3 col-sm-5 col-xs-5 card mb-2 pb-2">
                    <b class = "card-header">Inventory Management</b>
                    <p class = "card-body">Record Inventory Items Informations, Edit, Delete & Set Damage Items. Search  Informations by Desired Fields</p>
                    <a href = "view-inventory-mgmt.php" type="button" class="btn btn-dark" >Go >></a>
                </div>

                <div class = "col-lg-3 col-md-3 col-sm-5 col-xs-5 card mb-2 pb-2">
                    <b class = "card-header">Customer Information Management</b>
                    <p class = "card-body">Record, Edit & Delete Customers Information, Search  Informations by Desired Fields</p>
                    <a href = "view-customer-mgmt.php" type="button" class="btn btn-dark" >Go >></a>
                </div>
               
                <div class = "col-lg-3 col-md-3 col-sm-5 col-xs-5 card mb-2 pb-2">
                    <b class = "card-header">Daily Sales Management</b>
                    <p class = "card-body">Cashiers from different store branches can record, edit & delete daily sales</p>
                    <a href = "view-sale-mgmt.php" type="button" class="btn btn-dark" >Go >></a>
                </div>
                <?php //only STRATEGIC and Tactical level employee accounts can access into Report sectors...
                if($accessLevel != "Operational"){ ?>

                <div class = "col-lg-3 col-md-3 col-sm-5 col-xs-5 card mb-2 pb-2">
                    <b class = "card-header">Sales & Inventory Reports</b>
                    <p class = "card-body">Tactical & Strategic Levels Employees/ Admin can monitor and produce reports</p>
                    <a href = "report-dashboard.php" type="button" class="btn btn-dark" >Go >></a>
                </div>
                <?php } else { ?>
                 <div class = "col-lg-3 col-md-3 col-sm-5 col-xs-5 card mb-2 pb-2">
                    <b class = "card-header">Sales & Inventory Reports</b>
                    <p class = "card-body">Tactical & Strategic Levels Employees/ Admin can monitor and produce reports</p>
                    <a href = "#" type="button" class="btn btn-dark disabled" disabled>Go >></a>
                </div>

                <?php } ?>
            </div>
        </main>
         </div>
        </section>

        <footer class = "container mx-3">
            <p>Copyright  ©2022 Developed by May Phyu Sin Thant </p>
        </footer> 

    </body>
</html>