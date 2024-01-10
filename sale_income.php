<?php
    header('Content-Type: application/json');

    session_start();
    include("admin/conf/config.php");
     //if session auth is not set, redirect to login page
        $store = $_SESSION['filterStore'];
        //Calculatiing The Cost of Purchasing Products in Store 1
        $sqlQuery = "SELECT sales.itemID, itemlist.itemName, SUM(sales.qty) qty, 
        sales.actualsalePrice , saleinfo.storeNo
        FROM sales 
        JOIN itemlist 
        ON sales.itemID = itemlist.itemID  
        LEFT JOIN saleinfo
        ON sales.saleID = saleinfo.saleID
        WHERE saleinfo.storeNo = $store 
        GROUP BY itemlist.itemName ORDER BY itemlist.itemName";
        $result1 = $conn->query($sqlQuery);

        $data1 = array();
        foreach ($result1 as $row) {
            $data1[] = $row;
        }
        echo json_encode($data1);
    
        
?>
