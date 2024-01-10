<?php
    ob_start();
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");
    if($_SESSION['access_level']  != "Strategic"){
        header("location : /view-employee-mgmt.php");
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Add Employee</title>
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
        
    <body>
        <section class = "container mx-auto">
        <div class = "row mx-0 px-0 ">
        <?php 
        //sidebar
        include("sidebar.php"); ?>
        
        <main class = "col-lg-4 col-md-4 col-sm-12 col-xs-12 my-0 py-3 mx-auto px-auto ">
            <h3>Add New Employee</h3>
             <?php if (isset($_GET['incorrect'])){ ?>
                <div class = "alert alert-warning text-center">
                    This Employee Account Has Been Already Registered.
                </div>
            <?php  }  ?>
            <form id = "form" class = "form" method = "POST" enctype = "multipart/form-data">                
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text"> Employee Name : </span>
                        <input id = "employeeName" name = "employeeName" type = "text" 
                        oninvalid="validateLetter(this);"
                        oninput="validateLetter(this);" class = "form-control " required >
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text"> Default Password : </span>
                        <input id = "password" name = "password" type = "password" class = "form-control " required placeholder = "Set A Default Password for New Employees...">
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Address : </span>
                        <input id = "address" name = "address" type = "text" class = "form-control "  >
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Phone No : </span>
                        <input id = "phoneNo" name = "phoneNo" type = "text" class = "form-control "
                        oninvalid="validateNum(this);"
                        oninput="validateNum(this);"  required >
                     </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Email : </span>
                        <input id = "email" name = "email" type = "text" class = "form-control " required >
                     </div>
                    <div class = "input-group mb-3">
                        <span class = "input-group-text"> Position : </span>
                        <select id = "position1" name = "position1" class = "form-control " required onchange='CheckPosition();'> 
                            <option value = "0"> --- Choose Position ↓ ---</option>
                            <?php 
                                $result = "SELECT DISTINCT position FROM employee";
                                $stmt = $conn->query($result);                         
                                foreach($stmt as $row ) {     
                            ?>    
                            <option value="<?php echo $row['position'] ?>">      
                                <?php echo $row['position'] ?>    
                            </option>   <?php } ?>
                            <option value=" ">Add New Position</option> 
                        </select>  
                        <input type="text" name="position" id="positionBox" style='display:none;'/>             
                    </div>
                     <div class = "input-group mb-3">
                        <span class = "input-group-text"> Account Level : </span>
                        <select id = "accountLevel" name = "accountLevel" class = "form-control " required>
                            <option value = "0"> --- Choose Account Level : ↓ ---</option>
                            <?php 
                                $result = "SELECT DISTINCT `level` FROM accountlevel";
                                $stmt = $conn->query($result);                         
                                foreach($stmt as $row ) {     
                            ?>    
                            <option value="<?php echo $row['level'] ?>">      
                                <?php echo $row['level'] ?>    
                            </option>    
                                <?php } ?> 
                        </select>
                    </div>
                   
                    <div class = "input-group mb-3">
                        <span class = "input-group-text"> Store No : </span>
                        <select id = "storeNo" name = "storeNo" class = "form-control " required>
                            <option value = "0"> --- Choose Store No : ↓ ---</option>
                            <?php 
                                $result = "SELECT DISTINCT storeNo FROM location";
                                $stmt = $conn->query($result);                         
                                foreach($stmt as $row ) {     
                            ?>    
                            <option value="<?php echo $row['storeNo'] ?>">      
                                <?php echo $row['storeNo'] ?>    
                            </option>    
                                <?php } ?> 
                        </select>
                    </div>
                  
                    <div class = "input-group mb-3">
                        <span class = "input-group-text"> Remark : </span>
                        <select id = "remark" name = "remark" class = "form-control " required>
                            <option value = "0"> --- Active/ Inactive: ↓ ---</option>   
                            <option value="Active">Active</option>    
                            <option value="Inactive">Inactive</option>    
                        </select>
                    </div>

                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Profile Image : </span>
                        <input type="file" id = "profileImage" name = "profileImage" class = "form-control "   /></p>
                    </div>
                    <br>
                    <a href = "view-employee-mgmt.php" type = "button" class = "btn btn-white"> Back </a>
                    <button type="submit" class = "btn btn-dark" name="Save"   >Save</button>
                   
            </form>
        </main>
        </section>
    </body>
    <footer class = "container mx-3">
        <p>Copyright  ©2022 Developed by May Phyu Sin Thant </p>
    </footer> 
</html>
<?php
   if(isset($_POST["Save"])){
        $employeeName = $_POST['employeeName'];
        //password_hash method "CRYPT_Blowfish" algorithm is used to protect
        //password for security
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        
        $address = htmlspecialchars($_POST['address']);
        $phoneNo = $_POST['phoneNo'];
        $email = $_POST['email'];
        $position = $_POST['position1'].$_POST['position'];
        $accountLevel = $_POST['accountLevel'];
        $storeNo = $_POST['storeNo'];
        $remark = htmlspecialchars($_POST['remark']);
        $profileImage = $_FILES['profileImage']['name'];
        $tmp = $_FILES['profileImage']['tmp_name']; 
       
        if($profileImage){
            move_uploaded_file($tmp, "imgs/$profileImage");
        }

        $query = "SELECT * FROM `employee` WHERE email = ?  ";
        $stmt = $conn->prepare($query);
        $stmt->execute([$email]);
            
        $count= $stmt->rowCount();  
        //if location has already existed, error message appears
         
        //When this employee account does not exist, no integrity violation occurs. Can add current store no: and information.
        if($count != 1 ){
            $sql= "INSERT INTO `employee` (employeeName, `password`, `address`, phone, email, position, `level`,
            storeNo, remark , profileImage) 
            VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$employeeName, $password, $address, $phoneNo, $email, $position, $accountLevel, 
            $storeNo, $remark, $profileImage]);  
            header('location: view-employee-mgmt.php');
        } 
        else{
            header('location: add-employee.php?incorrect=1');
        }
       
    }
    ob_end_flush();
?>
    <script>
         function CheckPosition(){
            var element = document.getElementById("position1");
            var element2 = document.getElementById("positionBox");
            if(element.value ==' '){
            element2.style.display='block';
            }
            else {
            element2.style.display='none';
            }
        }
    </script>
  