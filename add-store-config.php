<?php 

        include("admin/conf/config.php");
        include("admin/conf/auth.php"); 
 
        if($_SESSION['access_level'] != "Strategic"){
                header("location : /add-store-config.php");
        }
        $companyName = htmlspecialchars($_POST['companyName']);
        $image = $_FILES['companyLogo']['name'];
        $tmp = $_FILES['companyLogo']['tmp_name']; 
        if($image){
            move_uploaded_file($tmp, "imgs/$image");
         }

        $query = "SELECT * FROM companyinfo";
        $stmt = $conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count= $stmt->rowCount(); 
        if($count = 1 ){
                $sql= "UPDATE companyinfo SET companyName = ? , logo = ? WHERE ID = 1";
        }
        if($count = 0){
                $sql= "INSERT INTO companyinfo (companyName, logo) VALUES ( ?, ?)";
        }
        $stmt = $conn->prepare($sql);
        $stmt->execute([$companyName, $image]);
        header("location: dashboard.php"); 

?>