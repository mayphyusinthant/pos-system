    <?php
      ob_start();
        include("admin/conf/config.php");
        include("admin/conf/auth.php"); 
 
        if(isset($_POST["Save"])){
        $itemName = $_POST['itemName'];
        $categoryName = $_POST['categoryName1'].$_POST['categoryName'];
        $description = htmlspecialchars($_POST['description']);
        $img = $_FILES['img']['name'];
        $tmp = $_FILES['img']['tmp_name']; 
        
        if($img){
            move_uploaded_file($tmp, "imgs/$img");
         }
   
        try {
            $sql= "INSERT INTO `itemlist` (itemName, categoryName, `description`, `image`) 
            VALUES ( ?, ?, ?, ? )";
            $stmt = $conn->prepare($sql);
            $stmt->execute([ $itemName, $categoryName, $description, $img]);  
            include("item-lists.php");
        }catch(PDOException $e){
            echo "Integrity Constraint Violation - This item might has been already recorded.
            <br><a href = 'item-lists.php'>Go Back</a>";
        }
    }
      ob_end_flush();
    ?>