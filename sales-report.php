<?php 
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");
    if($_SESSION['access_level']  == "Operational"){
        header("location : /sales-report.php");
    }
    
?>
<!DOCTYPE html>
    <html>
        <head>
            <title>Sales Reports</title>
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

            <h4>Monitoring Daily, Weekly, Monthly & Yearly Sale Reports
                <a href = "report-dashboard.php" type="button" class = "btn btn-warning"><b>Back</b></a>
            </h4>
         
            <hr>
                <div>
                    <h5 class = "my-3">Daily Total Sales In Each Store Within Selected Month </h6>
                    <form id = "form" class = "form row"  action = "sales-report.php" method = "POST">   
                        <div class = "col-lg-4 col-md-4 col-sm-6 col-xs-6 ">  
                            <table>
                                <tr>
                                    <td><span class = "input-group-text"> Min Date: </span></td>
                                    <td><input type="date" id="minDate" name="minDate" min="2019-01-01" max="2024-01-01" ></td>
                                    <td><span class = "input-group-text"> Max Date: </span></td>
                                    <td><input type="date" id="maxDate" name="maxDate" min="2019-01-01" max="2024-01-01"></td>
                                </td>
                            </table> 
                            <span clas = "my-3">
                                <button type="submit" class = "btn btn-dark " name="Save"   >Save</button>
                                <button type="submit" class = "btn btn-dark " name="Refresh"   >Refresh</button>
                                <a href = "#graphCanvas2" type="button" class = "btn btn-warning" >See Weekly Report >></a>
                               
                            </span>
                        </div>
                    </form>
                    <?php 
                        if(isset($_POST["Save"])){
                            $_SESSION['minDate'] = date("Y-m-d", strtotime($_POST['minDate'])); 
                            $_SESSION['maxDate'] = date("Y-m-d", strtotime($_POST['maxDate'])); 
                            //echo  $_SESSION['minDate']. $_SESSION['maxDate'];
                        } 
                        if(isset($_POST["Refresh"])){
                            unset($_SESSION['minDate']);
                            unset($_SESSION['maxDate']);
                        }  
                    ?> 
                    <canvas id="graphCanvas1"  ></canvas>
                    <h6> Y- Axis :  Total Sale (Actual Sale Price * Qty )</h6>
                    <h6> X- Axis :  Daily Total Sales in Each Store Branch </h6>
                    <h6> X- Label:  Total Sales, Date, Store No:</h6>
                    <hr>


                    <h6 class = "my-3"> Weekly Total Sales In Each Store Within A Year</h6>
                      <form id = "form" class = "form row"  method = "POST">   
                        <div class = "col-lg-4 col-md-4 col-sm-6 col-xs-6">            
                        <select id = "month" name = "month" class = "form-control " required>
                            <option value = "0"> --- Choose Month : ↓ ---</option>    
                                <option value="1">Janauary</option>    
                                <option value="2">February</option>    
                                <option value="3">March</option>    
                                <option value="4">April</option>    
                                <option value="5">May</option>    
                                <option value="6">June</option>    
                                <option value="7">July</option>    
                                <option value="8">August</option>    
                                <option value="9">September</option>    
                                <option value="10">October</option>    
                                <option value="11">November</option>    
                                <option value="12">December</option>    
                        </select>
                        <input type = "text" id = "year" name = "year" class = "form-control "  
                        placeholder = "Enter Year ( E.g: 2022, ...)" > </input>
                        </div>
                        <span class = "my-3">
                            <button type="submit" class = "btn btn-dark " name="Save1"   >Save</button>
                            <button type="submit" class = "btn btn-dark " name="Refresh1"   >Refresh</button>
                            <a href = "#graphCanvas3" type="button" class = "btn btn-warning" >See Monthly Report >></a>
                        </span>
                    </form>
                     <?php 
                        if(isset($_POST["Save1"])){
                            $_SESSION['month'] = $_POST['month']; 
                            $_SESSION['year'] = $_POST['year']; 
                            
                        } 
                        if(isset($_POST["Refresh1"])){
                            unset($_SESSION['month']);
                            unset($_SESSION['year']);
                        }  
                    ?> 
                    <canvas id="graphCanvas2"   ></canvas>
                   <?php 
                   if(isset($_SESSION['year']) && isset($_SESSION['month'])){ ?>
                         <b> Weekly Total Sales Report in <?php $monthNum  = $_SESSION['month'];
                        $monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
                        echo $monthName.'-'.$_SESSION['year']?></b>
                   <?php } ?> 
                    
                    <h6> Y- Axis :  Total Sale (Actual Sale Price * Qty )</h6>
                    <h6> X- Axis :  Weekly Total Sales in Each Store Branch </h6>
                    <h6> X- Label:  Total Sales, Week, Store No:</h6>


                    <h6 class = "my-3">Monthly Total Sales Within A Year </h6>
                      <form id = "form" class = "form row"  method = "POST">   
                        <div class = "col-lg-4 col-md-4 col-sm-6 col-xs-6">            
                            <input type = "text" id = "yearly" name = "yearly" class = "form-control "  
                            placeholder = "Enter Year ( E.g: 2022, ...)" > </input>
                        </div>
                        <span class = "my-3">
                            <button type="submit" class = "btn btn-dark " name="Save2"   >Save</button>
                            <button type="submit" class = "btn btn-dark " name="Refresh2"   >Refresh</button>
                            <a href = "#graphCanvas4" type="button" class = "btn btn-warning" >See Yearly Report >></a>
                        </span>
                    </form>
                     <?php 
                        if(isset($_POST["Save2"])){
                            $_SESSION['yearly'] = $_POST['yearly']; 

                        } 
                        if(isset($_POST["Refresh2"])){
                            unset($_SESSION['yearly']);
                        }  
                    ?> 
                    <canvas id="graphCanvas3"  ></canvas>
                    <?php  if(isset($_SESSION['yearly'])){ ?>
                        <b> Monthly Total Sales Report in <?php echo $_SESSION['yearly']?></b>
                    <?php } ?>
                    <h6> Y- Axis :  Total Sale (Actual Sale Price * Qty )</h6>
                    <h6> X- Axis :  Monthly Total Sales in Each Store Branch </h6>
                    <h6> X- Label:  Total Sales, Month, Store No:</h6>
                    <hr>


                    <h6 class = "my-3">Yearly Total Sales in Each Store (Between 2015 to 2025)</h6>
                    <canvas id="graphCanvas4"  ></canvas>
                    <h6> Y- Axis :  Total Sale (Actual Sale Price * Qty )</h6>
                    <h6> X- Axis :  Yearly Total Sales in Each Store Branch </h6>
                    <h6> X- Label:  Total Sales, Year, Store No:</h6>
                </div>
            </div>

            
        <script>
             $(document).ready(function () {
                dailySales();
                weeklySales();
                monthlySales();
                yearlySale();
            });

            function dailySales() {
                {
                    $.post("dailySale-report.php",
                    function (data) {
                        console.log(data);
                        var date = [];
                        var storeNo = [];
                        var sale = [];
                        for (var i in data) {
                            date.push(['Store No:', data[i].storeNo, 'Date:', data[i].saleDate]);
                            storeNo.push(data[i].storeNo);
                            sale.push(data[i].total_sale);
                        }
                        var chartdata = {
                            labels:   date, 
                            datasets: [
                                {
                                    label: 'Daily Total Sale in Each Store  Branch' ,
                                    backgroundColor: '#860C2E ',
                                    borderColor: '#46d5f1',
                                    hoverBackgroundColor: '#CCCCCC',
                                    hoverBorderColor: '#666666',
                                    data: sale,
                                }
                            ]
                        };
                        var graphTarget = $("#graphCanvas1");
                        var barGraph = new Chart(graphTarget, {
                            type: 'line',
                            data: chartdata,
                            lineWidth: '1px', 
                           
                        });
                       
                    });
                }
            }

            function weeklySales()
            {
                {
                     $.post("weeklySale-report.php",
                    function (data)
                    {
                        console.log(data);
                        var outcome = [];
                        var sale = [];
                        for (var i in data) {
                            outcome.push(['Store No:', data[i].storeNo, 'Week :' , data[i].sale_week]);
                            sale.push( data[i].total_sale);
                        }
                        var chartdata = {
                            labels:  outcome,
                            datasets: [
                                {
                                    label: 'Weekly Total Sale in Each Store  Branch' ,
                                    backgroundColor: '#860C2E ',
                                    borderColor: '#46d5f1',
                                    hoverBackgroundColor: '#CCCCCC',
                                    hoverBorderColor: '#666666',
                                    data: sale,
                                }
                            ]
                        };
                        var graphTarget = $("#graphCanvas2");
                        var barGraph = new Chart(graphTarget, {
                            type: 'line',
                            data: chartdata,
                            lineWidth: '1px',
                            
                        });
                    });
                }
            }

             function monthlySales()
            {
                {
                     $.post("monthly-report.php",
                    function (data)
                    {
                        console.log(data);
                        var outcome = [];
                        var sale = [];
                        for (var i in data) {
                            outcome.push(['Store No:', data[i].storeNo, 'Month :' , data[i].sale_Month]);
                            sale.push( data[i].total_sale);
                        }
                        var chartdata = {
                            labels:  outcome,
                            datasets: [
                                {
                                    label: 'Monthly Total Sale in Each Store  Branch' ,
                                    backgroundColor: '#860C2E ',
                                    borderColor: '#46d5f1',
                                    hoverBackgroundColor: '#CCCCCC',
                                    hoverBorderColor: '#666666',
                                    data: sale,
                                }
                            ]
                        };
                        var graphTarget = $("#graphCanvas3");
                        var barGraph = new Chart(graphTarget, {
                            type: 'line',
                            data: chartdata,
                            lineWidth: '1px',
                            
                        });
                    });
                }
            }

            function yearlySale()
            {
                {
                     $.post("yearly-report.php",
                    function (data)
                    {
                        console.log(data);
                        var outcome = [];
                        var sale = [];
                        for (var i in data) {
                            outcome.push(['Store No:', data[i].storeNo, 'Year :' , data[i].Year]);
                            sale.push( data[i].total_sale);
                        }
                        var chartdata = {
                            labels:  outcome,
                            datasets: [
                                {
                                    label: 'Yearly Total Sale in Each Store  Branch' ,
                                    backgroundColor: '#860C2E ',
                                    borderColor: '#46d5f1',
                                    hoverBackgroundColor: '#CCCCCC',
                                    hoverBorderColor: '#666666',
                                    data: sale,
                                }
                            ]
                        };
                        var graphTarget = $("#graphCanvas4");
                        var barGraph = new Chart(graphTarget, {
                            type: 'line',
                            data: chartdata,
                            lineWidth: '1px',
                            
                        });
                    });
                }
            }
            </script>

    </body>
</html>

