<?php
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");

?>
 

<!doctype html>
<html>
    <head>
        <title> Employee Profile </title>
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
    </head>
   
    <body>
        <section class = "container mx-auto">
        <div class = "row mx-0 px-0 ">
        <?php 
        //sidebar
        include("sidebar.php"); ?>

        <main class = "col-lg-8 col-md-8 col-sm-12 col-xs-12 my-0 py-3 mx-auto px-auto ">

            <div id="div1 container " style = "margin-top:50px;" >
            <div id="div2" class="card  shadow-lg col-lg-8 col-md-8 col-sm-10 col-xs-10" >
             <?php 
                    $query = "SELECT employee.* 
                    FROM employee 
                    WHERE employee.email = '$email'";
                            
                    $result = $conn->query( $query); 
                    foreach( $result as $row ) {  ?>

                <div class="col-12 user-img text-center" >
                     <img class="img2" src="imgs/<?php echo $profile?>"  width="30" > 
                </div>

                <div class="card-header text-center">
                    <h5>Your Account Information</h5>
                </div>
                <div class="card-body mx-5" >
                    <table class= "table table-border ">
                            
                           
                                <tr>
                                    <th>Your Name</th>
                                    <td> <?php echo $row['employeeName']?></td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td> <?php echo $row['address']?></td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td> <?php echo htmlspecialchars($row['phone'])?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td> <?php echo $row['email']?></td>
                                </tr>
                                <tr>
                                    <th>Position</th>
                                    <td> <?php echo $row['position']?></td>
                                </tr>
                                <tr>
                                    <th>Level</th>
                                    <td> <?php echo $row['level']?></td>
                                </tr>
                                <tr>
                                    <th>Assigned Store No:</th>
                                    <td> <?php echo $row['storeNo']?></td>
                                </tr>
                                
                                <?php } ?> 
                        </table>
                </div>
                <div class = "card-body text-center ">
                    <a href = "change-acc-info.php" type="button" class = "btn btn-dark "  >Change Account Info</a>
                    <a href = "change-acc-password.php" type="button" class = "btn btn-dark"  >Change New Password</a>
    
                </div>
                <div class="card-footer text-center text-muted">
                   
                    <h6>Rules and Regulations</h6>
                    <p> Employees are allowed to view their profile information via this page. 
                        They are allowed to set new password, change adress, phone number and can 
                        upload new profile photo. 
                        But it is restricted to change any sensitive informations including your account name, 
                        registered email address, your position, account level and assigned store number.
                        If it is necessary to change any of these information, you will need to contact to
                        the Admin team (strategic level).
                    </p>
                </div>
            </div>
        </main>
    </body>
  <footer class = "container mx-3">
            <p>Copyright  ©2022 Developed by May Phyu Sin Thant </p>
    </footer> 
    

</html>
<style>

    #div2 {
        margin: 0 auto;
        padding: 0px 10px;
        border-radius: 10px;
        margin-bottom: 20px;
      }  
    .img2 {
        margin-top: -40px;
        opacity: 0.8;
        width: 80px;
        height: 80px;
        border-radius: 50%;
      }

</style>