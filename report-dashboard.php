<?php
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");

    if($_SESSION['access_level']  == "Operational"){
        header("location : /report-dashboard.php");
    }

    $email = $_SESSION['email'];
    $results = "SELECT level FROM `employee` WHERE email = '$email'" ;
    $sql = $conn->query( $results); 
    foreach( $sql as $row ) {
        $accessLevel = $row['level'];
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Report Dashboard</title>
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
        
        <main class = "col-lg-4 col-md-8 col-sm-12 col-xs-12 my-0 py-3 mx-1 px-auto ">
            <div class = "card">
                <h5 class= "card-header"> See Expense - Income Reports </h5>
                <p class = "card-body"> <b> Expense </b> (Cost of Purchasing Products )  for Every Store Branches
                are represented in graphical illustrations. In stock availability of products, original (purchase)
                price and total spending costs of each item are monitored. Authorized administrators can filter 
                this reports by desired store No:. <br>
                Moreover, <b> Sale Incomes </b> of Each items can be tracked from each store branches. 
                <br> As an advantage, adminstrator can monitor in stock availabitly of products and their popularity 
                of sales for each item which will help them in decision making processes.
                </p>
                <a href = "expense-income-report.php" type = "button" class = "btn btn-dark" > Go >> </a>
            </div>
        </main>

        <main class = "col-lg-4 col-md-8 col-sm-12 col-xs-12 my-0 py-3 mx-1 px-auto ">
            <div class = "card">
                <h5 class= "card-header"> See Sales Reports By Advanced Filters</h5>
                <p class = "card-body"> <b> Sales Reports </b> ( for Every Store Branches
                are represented in graphical illustrations.  <br>
                Authorized Administrations can monitor <b> Sales Income </b> from every store branches and
                can see daily, weekly, monthly or yearly representative reports.     
                </p>
                <a href = "sales-report.php" type = "button" class = "btn btn-dark" > Go >> </a>
            </div>
        </main>
         </div>
        </section>

        <footer class = "container mx-3">
            <p>Copyright  ©2022 Developed by May Phyu Sin Thant </p>
        </footer> 

    </body>
</html>