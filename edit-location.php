<?php 
    ob_start();
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");
    if($_SESSION['access_level']  != "Strategic"){
        header("location : /edit-location.php");
    }

    $storeNo = $_GET['storeNo'];
    $add = $_GET['address'];
    $ph = $_GET['officePhone'];
    $mail = $_GET['officeEmail'];
    $manager = $_GET['storeManager'];

    $result = "SELECT * FROM `location` WHERE storeNO = $storeNo";
    $stmt = $conn->query($result);
        
?>
<!doctype html> 
    <html> 
         <head>
        <title>Store Location</title>
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
            <h3>Edit Store Location </h3>
             <?php if (isset($_GET['incorrect'])){ ?>
                <div class = "alert alert-warning text-center">
                    Store Location is Duplicated. 
                </div>
            <?php  }  ?>
            <form id = "form" class = "form" method = "POST" >   
 
                    <input type="hidden" name="storeNo" value="<?php echo $storeNo ?>">
                     <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Address : </span>
                        <input id = "address" name = "address" value = "<?php echo $add?>"  type = "text" class = "form-control " required >
                    </div>
                     <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Office Phone : </span>
                        <input id = "officePhone" name = "officePhone" value = "<?php echo $ph ?>"  
                        oninvalid="validateNum(this);"
                        oninput="validateNum(this);" type = "text" class = "form-control " required >
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Office Email : </span>
                        <input id = "officeEmail" name = "officeEmail" value = "<?php echo $mail ?>"  type = "text" class = "form-control " required >
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
                    <button type="submit" class = "btn btn-dark" name="Save" >Update</button>
                   
            </form>
        </main>
        </section>
    </body> 
    <footer class = "container mx-3">
        <p>Copyright  ©2022 Developed by May Phyu Sin Thant </p>
    </footer> 

    <?php
     if(isset($_POST['Save'])) {
         
        $address = $_POST['address'];
        $officePhone = $_POST['officePhone'];
        $officeEmail = $_POST['officeEmail'];
        $storeManager = $_POST['storeManager'];


        $sql = "UPDATE `location` SET  `address` = ?, 
        officePhone = ? , officeEmail = ?,  storeManager = ? 
        WHERE storeNo = ? ";   
        $stmt = $conn->prepare($sql);
        $stmt->execute([$address, $officePhone, $officeEmail, $storeManager, $storeNo]);
        header("location: store-location.php");
     }
         ob_end_flush();

?>