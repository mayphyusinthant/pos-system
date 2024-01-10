<?php
    header('Content-Type: application/json');

    session_start(); 
    include("admin/conf/config.php");
        $year = $_SESSION['yearly'];

        $sqlQuery = "SELECT SUM(sales.qty* 
        sales.actualsalePrice) total_sale , saleinfo.storeNo, Month(saleinfo.saleDate) as sale_Month, Year(saleinfo.saleDate) as Year
        FROM sales 
        LEFT JOIN saleinfo
        ON sales.saleID = saleinfo.saleID
        WHERE Year(saleinfo.saleDate) = $year
        GROUP BY saleinfo.storeNo, sale_Month ";
        $result1 = $conn->query($sqlQuery);

        $data1 = array();
        foreach ($result1 as $row) {
            $data1[] = $row;
        }
        echo json_encode($data1);
        
        
        
?>
