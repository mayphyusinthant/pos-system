<?php
header('Content-Type: application/json');

    session_start();
    include("admin/conf/config.php");
        $month = $_SESSION['month'];
        $year = $_SESSION['year'];

        $sqlQuery = "SELECT SUM(sales.qty* 
        sales.actualsalePrice) total_sale , 
        saleinfo.storeNo, Week(saleinfo.saleDate) as sale_week, Year(saleinfo.saleDate) as Year
        FROM sales 
        LEFT JOIN saleinfo
        ON sales.saleID = saleinfo.saleID
        WHERE Month(saleinfo.saleDate) = $month 
        && Year(saleinfo.saleDate) = $year
        GROUP BY sale_week, saleinfo.storeNo ";
        $result1 = $conn->query($sqlQuery);

        $data1 = array();
        foreach ($result1 as $row) {
            $data1[] = $row;
        }
        echo json_encode($data1);
        
        
        
?>
