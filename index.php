<?php
    session_start();
    include("admin/conf/config.php");
            if(isset($_POST['email']) AND isset($_POST['password'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
               
                $query = "SELECT * FROM employee WHERE email = ?  ";
                $stmt = $conn->prepare($query);
                $stmt->execute([$email]);
            
                $employee = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $count= $stmt->rowCount();  
                //When employee account does NOT exist
                if($count != 1 ){
                    $_SESSION['auth'] = FALSE;
                    header('location: index.php?incorrect=1');
                } 
                //When employee account exists
                if($count = 1) {
                   foreach($employee as $row) {
                        if($row['remark'] != "Inactive"){
                            //decode the hashed password '$row['password'] and match with input_password
                            if(password_verify($password, $row['password']))  {
                                $_SESSION['auth'] = TRUE;
                                $_SESSION['email'] = $row['email'];
                                header("location: dashboard.php");  
                            }
                            else {
                                $_SESSION['auth'] = FALSE;
                                header('location: index.php?incorrect=1.php');  
                            }
                        } else {
                          $_SESSION['auth'] = FALSE;
                         header('location: index.php?inactive=1');
                       }
                }  
            }
        }
?>

<!DOCTYPE html>
<html>
    <header>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Author: May Phyu Sin Thant, Capital E-Commerce Website">

        <title>Login Form</title>
        <!--External Css File-->
        <link rel = "stylesheet" href = "LoginStyle.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">   

    </header>
   
    </style>
    <body class = "container  mx-auto">
    
        <div class= "container shadow-lg col-lg-6 col-md-8 col-sm-10 col-xs-10 " >
            <form id = "form" class = "form card"  method = "POST">
                <div class = "card-body">
                    <h3>POS System for Clothing Store</h3><br>

                    <h6>Welcome from the Point of Sale System for Clothing Store. Please login with employee account - email and password. </h6>
                    <?php if (isset($_GET['incorrect'])){ ?>
                            <div class = "alert alert-warning text-center">
                                Incorrect Email or Password
                            </div>
                    <?php  } else if(isset($_GET['inactive'])) { ?>
                            <div class = "alert alert-warning text-center">
                                This account is  temporarily unavailable. For More Info, Please Contact to Admin Team.
                                <b>Possilbe Issue : Inactive Account</b>
                            </div>
                    <?php  } ?>
                </div>
                <div class = "form-control card-body">
                    <label for = "username">Email</label>
                    <input type = "email" id = "email" name = "email" placeholder = "Enter Email" required>
                </div>
                <div class = "form-control card-body">
                    <label for = "password">Password</label>
                    <input type = "password" id = "password" name = "password" required placeholder = "Enter Password">
                </div>
                    <button  type="submit" class = "card-footer" value="submit">Login</button>
            </form>
        </div>
  
       </body>
</html>