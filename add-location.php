<?php
   
    ob_start();
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");
    if($_SESSION['access_level']  != "Strategic"){
        header("location : /add-location.php");
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Store Location</title>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

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
            <h3>Add Store Location</h3>
             <?php if (isset($_GET['incorrect'])){ ?>
                <div class = "alert alert-warning text-center">
                    Store Location is Duplicated. 
                </div>
            <?php  }  ?>
            <form id = "form" class = "form input-group needs-validation" method = "POST" >                
                  
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Store No : </span>
                        <input id = "StoreNo" name = "StoreNo" type = "text" 
                        class = "form-control "  oninvalid="validateNum(this);"
                        oninput="validateNum(this);" 
                         required >
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Address : </span>
                        <input id = "address" name = "address" type = "text" class = "form-control "
                           required >
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Office Phone : </span>
                        <input id = "officePhone" name = "officePhone" type = "text" class = "form-control " 
                         oninvalid="validateNum(this);"
                        oninput="validateNum(this);" required >
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Office Email : </span>
                        <input id = "officeEmail" name = "officeEmail" type = "text" class = "form-control " required >
                    </div>
                     <div class = "input-group mb-3">
                        <span class = "input-group-text"> Store Manager : </span>
                        <select id = "storeManager" name = "storeManager" class = "form-control " required>
                            <option value = "0"> --- Assign Manager to Store ↓ ---</option>
                            <?php 
                                $result = "SELECT DISTINCT employeeName, position, storeNo, `level` FROM employee WHERE 
                                `level` = 'Tactical'";
                                $stmt = $conn->query($result);                         
                                foreach($stmt as $row ) {     
                            ?>    
                            <option value="<?php echo $row['employeeName'] ?>">      
                                <?php echo $row['employeeName'].'('.$row['level'].') from store '.$row['storeNo'] ?>    
                            </option>    
                                <?php } ?> 
                        </select>
                    </div>
                    <br>
                    <a href = "store-location.php" type = "button" class = "btn btn-white"> Back </a>
                    <button type="submit" class = "btn btn-dark" name="Save" >Save</button>
                   
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
        $companyID = 1; // 1 is default companyID
        $storeNo = $_POST['StoreNo'];
        $address = htmlspecialchars($_POST['address']);
        $phone = $_POST['officePhone'];
        $email = $_POST['officeEmail'];
        $manager = htmlspecialchars($_POST['storeManager']);
       
        $query = "SELECT * FROM location WHERE storeNo = ?  ";
        $stmt = $conn->prepare($query);
        $stmt->execute([$storeNo]);
            
        $count= $stmt->rowCount();  
        //if location has already existed, error message appears
         
        //When location does not exist, no integrity violation occurs. Can add current store no: and information.
        if($count != 1 ){
            $sql= "INSERT INTO `location` (companyID, storeNo, `address`, officePhone, officeEmail, storeManager) 
            VALUES ( ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$companyID, $storeNo, $address, $phone, $email, $manager]);  
            header('location: store-location.php');
        } 
        else{
            header('location: add-location.php?incorrect=1');
        }
       
    }
    ob_end_flush();
?>