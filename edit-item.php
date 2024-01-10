<?php 
    ob_start();
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");
   
    $ID = $_GET['itemID'];
    $item = $_GET['itemName'];
    $cat = $_GET['categoryName'];
    $desc = $_GET['description'];

    $result = "SELECT * FROM `itemlist` WHERE itemID = $ID";
    $stmt = $conn->query($result);
        
?>
<!doctype html> 
    <html> 
         <head>
        <title>Item Lists</title>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Author: May Phyu Sin Thant, PHP POS System for Clothing Store. Implemented in February, 2022">
        <link rel = "stylesheet" href = "css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    </head>
        
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
            <h3>Edit Item Lists </h3>
             <?php if (isset($_GET['incorrect'])){ ?>
                <div class = "alert alert-warning text-center">
                    Error: This item has been already recorded.
                </div>
            <?php  }  ?>
            <form id = "form" class = "form" method = "POST" enctype = "multipart/form-data">                
                    <input type="hidden" name="itemID" value="<?php echo $ID ?>">
                     <div class = "input-group mb-3"> 
                        <span class = "input-group-text"> Item Name : </span>
                        <input id = "itemName" name = "itemName" type = "text" placeholder = "<?php echo $item ?>" class = "form-control " required >
                    </div>

                    <div class = "input-group mb-3">
                        <span class = "input-group-text"> Category Name : </span>
                        <select id = "categoryName1" name = "categoryName1" class = "form-control " required onchange = 'CheckCategory()';>
                            <option value = "0"> --- Choose Category : ↓ ---</option>
                            <?php 
                                $result = "SELECT DISTINCT categoryName FROM itemlist";
                                $stmt = $conn->query($result);                         
                                foreach($stmt as $row ) {     
                            ?>    
                            <option value="<?php echo $row['categoryName'] ?>">      
                                <?php echo $row['categoryName'] ?>    
                            </option>    
                            <?php } ?>
                            <option value=" ">Add New Category</option>
                        </select>
                            <input type="text" name="categoryName" id="categoryNamebox" style='display:none;'/>

                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Description : </span>
                        <input id = "description" name = "description" type = "text " placeholder = "<?php echo $desc ?>" class = "form-control "  >
                    </div>
                    <div class = "input-group mb-3"> 
                        <span class = "input-group-text">  Image : </span>
                        <input type="file" id = "img" name = "img" class = "form-control " /></p>
                    </div>
                    <br>
                    <a href = "item-lists.php" type = "button" class = "btn btn-white"> Back </a>
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
         
        $itemID = $_POST['itemID'];
        $itemName = $_POST['itemName'];
        $categoryName = $_POST['categoryName1'].$_POST['categoryName'];
        
        $description = $_POST['description'];
        $img = $_FILES['img']['name'];
        $tmp = $_FILES['img']['tmp_name']; 
        
        if($img){
            move_uploaded_file($tmp, "imgs/$img");
        }
   try {
       
      $sql = "UPDATE `itemlist` SET  `itemName` = ?, 
        categoryName = ? , `description` = ?, `image` = ?
        WHERE itemID = ? ";   
        $stmt = $conn->prepare($sql);
        $stmt->execute([$itemName, $categoryName, $description, $img, $itemID]);
        header("location: item-lists.php");
        } 
    catch(PDOException $e){
            echo "Integrity Constraint Violation - This item might has been already recorded.
            <br><a href = 'item-lists.php'>Go Back</a>";
        }
    } 
         ob_end_flush();
?>
   <script>
         function CheckCategory(){
            var element = document.getElementById("categoryName1");
            var element2 = document.getElementById("categoryNamebox");
            if(element.value ==' '){
                element2.style.display='block';
            }
            else {
                element2.style.display='none';
            }
        }
    </script>