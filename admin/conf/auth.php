<?php  
    session_start();  
    include("admin/conf/config.php");

    if(!isset($_SESSION['auth'])) {    
        header("location: index.php");    
        exit();  
    }else {
        $email = $_SESSION['email'];
        $query = "SELECT DISTINCT employee.level FROM employee WHERE email = ?";
        $stmt = $conn->prepare($query);
        $control = $stmt->execute([$email]);  
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row) {
            $_SESSION['access_level'] = $row['level'];
            //echo $_SESSION['access_level'];
        }
    } 
?>

