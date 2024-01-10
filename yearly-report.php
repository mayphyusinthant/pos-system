<?php
    header('Content-Type: application/json');

    session_start();
    include("admin/conf/config.php");

        $sqlQuery = "SELECT SUM(sales.qty* 
        sales.actualsalePrice) total_sale , saleinfo.storeNo, Year(saleinfo.saleDate) as Year
        FROM sales 
        LEFT JOIN saleinfo
        ON sales.saleID = saleinfo.saleID
        WHERE Year(saleinfo.saleDate) >= 2015 AND Year(saleinfo.saleDate) <= 2025
        GROUP BY saleinfo.storeNo, Year";
        $result1 = $conn->query($sqlQuery);

        $data1 = array();
        foreach ($result1 as $row) {
            $data1[] = $row;
        }
        echo json_encode($data1);
    
?>
