<?php
header('Content-Type: application/json');

    session_start();
    include("admin/conf/config.php");
     //if session auth is not set, redirect to login page
        $minDate = $_SESSION['minDate'];
        $maxDate = $_SESSION['maxDate'];

        //Calculatiing The Cost of Purchasing Products in Store 1
        $sqlQuery = "SELECT SUM(sales.qty* 
        sales.actualsalePrice) total_sale , saleinfo.storeNo, saleinfo.saleDate
        FROM sales 
        LEFT JOIN saleinfo
        ON sales.saleID = saleinfo.saleID
        WHERE saleinfo.saleDate >= '$minDate' AND saleinfo.saleDate <= '$maxDate' 
        GROUP BY saleinfo.saleDate, saleinfo.storeNo";
        $result1 = $conn->query($sqlQuery);

        $data1 = array();
        foreach ($result1 as $row) {
            $data1[] = $row;
        }
        echo json_encode($data1);
?>

