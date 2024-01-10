<?php 
    ob_start();

    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");
    
    if($_SESSION['access_level']  != "Strategic"){
        header("location : /edit-employee.php");
    }

    $ID = $_GET['employeeID'];
    $NA = $_GET['employeeName'];
    $mail = $_GET['email'];
    $add = $_GET['address'];
    $ph = $_GET['phone'];
    $pos = $_GET['position'];
    $lev = $_GET['level'];

    $result = "SELECT * FROM `employee` WHERE employeeID = $ID";
    $stmt = $conn->query($result);
        
?>
<!doctype html> 
    <html> 
         <head>
        <title>Edit Employee Information</title>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Author: May Phyu Sin Thant, PHP POS System for Clothing Store. Implemented in February, 2022">
        <link rel = "stylesheet" href = "css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    </head>
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
            <h3>Edit Employee Information </h3>
            
            <form id = "form" class = "form" method = "POST" enctype = "multipart/form-data">                
                    <input type="hidden" name="employeeID" value="<?php echo $ID ?>">

                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text"> Employee Name : </span>
                        <input id = "employeeName" name = "employeeName" value = "<?php echo $NA?>" 
                        type = "text" class = "form-control "  oninvalid="validateLetter(this);"
                        oninput="validateLetter(this);"  required >
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Address : </span>
                        <input id = "address" name = "address" value = "<?php echo $add?>"  type = "text" class = "form-control "  >
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Phone No : </span>
                        <input id = "phoneNo" name = "phoneNo" value = "<?php echo $ph?>"  type = "text" 
                        class = "form-control " oninvalid="validateNum(this);"
                        oninput="validateNum(this);" required >
                     </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Email : </span>
                        <input id = "email" name = "email" value = "<?php echo $mail?>"  type = "text" 
                        class = "form-control " required >
                     </div>

                    <div class = "input-group mb-3">
                        <span class = "input-group-text"> Position : </span>
                            <select id = "position1" name = "position1" class = "form-control " required onchange='CheckPosition();'> 
                                <option value = "0"> --- Choose position ↓ ---</option>
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
                        <input type="text" name="position" id="positionbox" style='display:none;'/>             
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
                    <button type="submit" class = "btn btn-dark" name="Save" >Update</button>
                   
            </form>
        </main>
        </section>
    </body> 
    <footer class = "container mx-3">
        <p>Copyright  ©2022 Developed by May Phyu Sin Thant </p>
    </footer> 

    <?php
      try {
          if(isset($_POST['Save'])) {
            $employeeID = $_POST['employeeID'];
            $employeeName = $_POST['employeeName'];
            $address = $_POST['address'];
            $phoneNo = $_POST['phoneNo'];
            $email = $_POST['email'];
            $position = $_POST['position1'].$_POST['position'];
            $accountLevel = $_POST['accountLevel'];
            $storeNo = $_POST['storeNo'];
            $remark = $_POST['remark'];
            $profileImage = $_FILES['profileImage']['name'];
            $tmp = $_FILES['profileImage']['tmp_name'];

            $sql = "UPDATE `employee` SET  employeeName = ? ,  `address` = ?, 
            phone = ? , email = ?, position = ?,  `level` = ?,  storeNo = ? ,
            remark = ?, profileImage = ? WHERE employeeID = ? ";   
            $stmt = $conn->prepare($sql);
            $stmt->execute([$employeeName, $address, $phoneNo, $email, $position,
            $accountLevel, $storeNo, $remark, $profileImage, $employeeID]);
            
            header("location: view-employee-mgmt.php"); 
        }
    }catch(PDOException $e){
        echo "Invalid / Wrong User Input - Store Number or Account Level is not existed. Please check again";
       
    }
         ob_end_flush();

?>
  <script>
         function CheckPosition(){
            var element = document.getElementById("position1");
            var element2 = document.getElementById("positionbox");
            if(element.value ==' '){
            element2.style.display='block';
            }
            else {
            element2.style.display='none';
            }
        }
    </script>
  