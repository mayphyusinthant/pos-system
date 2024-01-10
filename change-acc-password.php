<?php
    ob_start();

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
        
        <main class = "col-lg-4 col-md-4 col-sm-12 col-xs-12 my-0 py-3 mx-auto px-auto ">
            <br><br>
            <h3>Change Account Password</h3>
             <?php if (isset($_GET['incorrect'])){ ?>
                <div class = "alert alert-warning text-center">
                    Please Try Again. Current Password is wrong or New passwords do not match. 
                </div>
            <?php  }  ?>
            <form id = "form" class = "form" method = "POST" enctype = "multipart/form-data">                
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Current Password : </span>
                        <input id = "oldpass" name = "oldpass" type = "text" class = "form-control "  required>
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">   New Password : </span>
                        <input id = "pass1" name = "pass1" type = "text" class = "form-control "  required>
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Enter Password Again : </span>
                        <input id = "pass2" name = "pass2" type = "text" class = "form-control " required >
                    </div>
                    <br>
                    <a href = "view-profile.php" type = "button" class = "btn btn-white"> Back </a>
                    <button type="submit" class = "btn btn-dark" name="Save" >Save</button>
                   
            </form>
        </main>
        </section>
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
</style>
<?php
   if(isset($_POST["Save"])){
        $oldpass = $_POST['oldpass'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];

    try {  
        if($pass1 == $pass2){
            echo "Pass 1";
            $sql = "SELECT  `password` FROM employee WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$email]);
            foreach( $stmt as $row ) {
               
                if(password_verify($oldpass, $row['password'])){
                    
                    //Hashing The New Password
                    $newpass = password_hash($pass1, PASSWORD_BCRYPT);
                    $sql = "UPDATE `employee` SET  `password` = ?
                    WHERE email = ?  ";   
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$newpass,$email]);
                    header("location: view-profile.php");
                }else {
                    header('location: change-acc-password.php?incorrect=1');
                }
            }
        }
        else {
                header('location: change-acc-password.php?incorrect=1');
            }
    }catch(PDOException $e){
            echo "Unknown Error Occured. Please Try Again. 
            <br><a href = 'view-profile.php'>Go Back</a>";
        }
    }
    ob_end_flush();
?>