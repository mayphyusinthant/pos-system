<?php 
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");
     if($_SESSION['access_level']  == "Operational"){
        header("location : /expense-income-report.php");
    }

?>
<!DOCTYPE html>
    <html>
        <head>
            <title>Reports</title>
            <meta charset = "UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="Author: May Phyu Sin Thant, PHP POS System for Clothing Store. Implemented in February, 2022">
            <link rel = "stylesheet" href = "css/style.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    </head>
            
             <!--Required CDN: Bootstrap | Popper | Jquery to Work Boostrap Collapse Properly-->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>  
            

            <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

            <script type="text/javascript" src="js/jquery.min.js"></script>
            <script type="text/javascript" src="js/Chart.min.js"></script>

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
        
        <main class = "col-lg-8 col-md-8 col-sm-12 col-xs-12 my-0 py-3 mx-auto px-auto ">

            <h4>Monitoring Inventory Vs Sale Reports
                <a href = "report-dashboard.php" type="button" class = "btn btn-warning"><b>Back</b></a>
            </h4>
                <div class = "container my-5">
                    <form id = "form" class = "form row"  method = "POST">   
                        <div class = "col-lg-4 col-md-4 col-sm-6 col-xs-6">            
                        <select id = "storeNo" name = "storeNo" class = "form-control " required>
                            <option value = "0"> --- Choose Store No : ↓ ---</option>
                                <?php 
                                    $result = "SELECT DISTINCT storeNo FROM location";
                                    $stmt = $conn->query($result);                         
                                    foreach($stmt as $row ) {     
                                ?>    
                                <option value="<?php echo $row['storeNo'] ?>">      
                                    <?php echo $row['storeNo'] ?>    
                                </option>    
                                    <?php } ?> 
                        </select>
                        </div>
                        <span class = "col-lg-6 col-md-6 col-sm-12 col-xs-12 " >
                            <button type="submit" class = "btn btn-dark " name="Save"   >Save</button>
                            <button type="submit" class = "btn btn-dark " name="Refresh"   >Refresh</button>
                            <a href = "#card" type="button" class = "btn btn-dark ">Monitor Expense - Income</a>
                        </span> 
                    </form>
               
            <?php 
                if(isset($_POST["Save"])){
                    $_SESSION['filterStore'] = $_POST['storeNo']; 
                } 
                if(isset($_POST["Refresh"])){
                    unset($_SESSION['filterStore']);
                    
                }  
            ?> 
            <hr>
                <div>
                    <h5 class = "my-3">Report: Direct Expense/ Cost of Purchasing Products For Each Store: </h6>
                    <canvas id="graphCanvas1"  ></canvas>
                    <h6> Y- Axis : Purchase Price * InstockQty </h6>
                    <h6> X- Axis : Available Items in Inventory of Each Store No:</h6>
                    <h6> X- Label: Item Name & In Stock Qty </h6>
                    <hr>
                    <h6 class = "my-3">Report: Income of Each Product in Each Store: </h6>
                    <canvas id="graphCanvas2"  ></canvas>
                    <h6> Y- Axis : Actual Sale Price * Sold Out Qty </h6>
                    <h6> X- Axis : Sold Out Items in Each Store No:</h6>
                    <h6> X- Label: Item Name & Sold Out Qty </h6>
                </div>
            </div>

             <div id="chart-container mx-auto " >
                <div class = " row container mt-5 " id = "card"  >
                    <div class = "col-5 card mx-3">
                        <?php $expense = "SELECT SUM(inventory.instockqty * inventory.purchasePrice) TOTAL_EXPENSE, 
                        inventory.storeNo FROM inventory GROUP BY inventory.storeNo" ;
                        $sql = $conn->query($expense); ?>

                        <h6> Cost of Products Expense in Each Store</h6>
                        <table class = "table table-border w-auto" style = "border : 3px solid #860C2E;">
                            <tr>
                                <th>Store No: </th>
                                <th>Products Expense </th>
                            </tr>
                        
                            <?php foreach ($sql as $row1) { ?>
                            <tr>
                                <td><?php echo $row1['storeNo']; ?></td>
                                <td><?php echo $row1['TOTAL_EXPENSE'].' MMK'; ?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <div class = "col-5 card mx-3">
                        <?php $expense = "SELECT SUM(sales.qty * sales.actualsalePrice) TOTAL_INCOME , 
                        saleinfo.storeNo FROM sales LEFT JOIN saleinfo 
                        ON sales.saleID = saleinfo.saleID GROUP By saleinfo.storeNo " ;
                        $sql = $conn->query($expense); ?>
                        <h6> Cost of Sale Incomes in Each Store</h6>

                        <table class = "table table-border w-auto" style = "border : 3px solid #860C2E;">
                            <tr>
                                <th>Store No: </th>
                                <th>Total Income</th>
                            </tr>
                        
                            <?php foreach ($sql as $row2) { ?>
                            <tr>
                                <td><?php echo $row2['storeNo']; ?></td>
                                <td><?php echo $row2['TOTAL_INCOME'].' MMK'; ?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div> 
            </div>
        <script>
             $(document).ready(function () {
                showExpenseGraph();
                showIncomeGraph();
            });

            function showExpenseGraph()
            {
                {
                    $.post("inventory_expense.php",
                    function (data)
                    {
                        console.log(data);
                        var item = [];
                        var outcome = [];
                        var qty = [];
                        for (var i in data) {
                            item.push([ data[i].itemName, data[i].instockqty, data[i].purchasePrice]);
                            outcome.push([ data[i].instockqty * data[i].purchasePrice]);
                            qty.push(data[i].instockqty);
                        }
                        var chartdata = {
                            labels:  item,
                            datasets: [
                                {
                                    label: 'Costs of Purchasing Products in Store.<?php echo $_SESSION['filterStore']?>' ,
                                    backgroundColor: '#860C2E ',
                                    borderColor: '#46d5f1',
                                    hoverBackgroundColor: '#CCCCCC',
                                    hoverBorderColor: '#666666',
                                    data: outcome, 
                                }
                            ]
                        };
                        var graphTarget = $("#graphCanvas1");
                        var barGraph = new Chart(graphTarget, {
                            type: 'bar',
                            data: chartdata,
                            lineWidth: '1px', 
                           
                        });
                       
                    });
                }
            }

            function showIncomeGraph()
            {
                {
                    $.post("sale_income.php",
                    function (data)
                    {
                        console.log(data);
                        var item = [];
                        var outcome = [];
                        for (var i in data) {
                            item.push([ data[i].itemName, data[i].qty ] );
                            outcome.push(data[i].qty * data[i].actualsalePrice);
                        }
                        var chartdata = {
                            labels:  item,
                            datasets: [
                                {
                                    label: 'Costs of Purchasing Products in Store.<?php echo $_SESSION['filterStore']?>' ,
                                    backgroundColor: '#992D06',
                                    borderColor: '#46d5f1',
                                    hoverBackgroundColor: '#CCCCCC',
                                    hoverBorderColor: '#666666',
                                    data: outcome,
                                }
                            ]
                        };
                        var graphTarget = $("#graphCanvas2");
                        var barGraph = new Chart(graphTarget, {
                            type: 'bar',
                            data: chartdata,
                            lineWidth: '1px', 
                            
                        });
                    });
                }
            }
            </script>

    </body>
</html>