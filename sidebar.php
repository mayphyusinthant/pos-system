<?php
    include("admin/conf/config.php");

    $email = $_SESSION['email'];
    $results = "SELECT level FROM `employee` WHERE email = '$email'" ;
    $sql = $conn->query( $results); 
    foreach( $sql as $row ) {
        $accessLevel = $row['level'];
    }
?>
<!--side bar - links collection-->
        <aside class = "col-lg-3 col-md-4 col-sm-12 col-xs-12 my-3 py-3 mx-0 px-0 card">
            <nav class="navbar navbar-expand-lg  navbar-expand-md  " id = "sidebar-wrapper">
                 <div class="container-fluid">
                 
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <ul class="sidebar-nav">
                            <li><a class="sidebar-nav-item" href="dashboard.php"  aria-current="page">
                                <img src = "imgs\dashboard logo.jpg" alt = "logo" > </img>Dashboard</a>
                            </li>
                            <?php 
                            if($accessLevel != "Strategic"){ 
                            //only STRATEGIC level employee accounts can access 
                            //=> COMPANY information & LOCATION configuration and
                            //=>  Employee Accounts Managment
                            ?>
                                <li><a class="sidebar-nav-item " href="#"  aria-current="page" >
                                    <img src = "imgs\store config.png" alt = "logo" > </img>Company Info Configuration</a>
                                </li>

                                <li><a class="sidebar-nav-item " href="#"  aria-current="page" >
                                    <img src = "imgs\locations.png" alt = "logo" > </img>Store Location(s)</a>
                                </li>

                                 <li><a class="sidebar-nav-item" href="#"  aria-current="page">
                                    <img src = "imgs\employee account management.png" alt = "logo"></img>Employee Account Management</a>
                                </li>
                            <?php }else { ?>
                                <li><a class="sidebar-nav-item" href="company-info-config.php"  aria-current="page">
                                    <img src = "imgs\store config.png" alt = "logo" > </img>Company Info Configuration</a>
                                </li>

                                <li><a class="sidebar-nav-item" href="store-location.php"  aria-current="page">
                                    <img src = "imgs\locations.png" alt = "logo"></img>Store Location(s)</a>
                                </li>

                                  <li><a class="sidebar-nav-item" href="view-employee-mgmt.php"  aria-current="page">
                                    <img src = "imgs\employee account management.png" alt = "logo"></img>Employee Account Management</a>
                                </li>

                            <?php }  
                            //Operational level accounts cannot access => Employee Accounts Mgmt & Suppliers Info Mgmt...
                             if($accessLevel != "Operational"){ ?>
                              
                                <li><a class="sidebar-nav-item" href="view-supplier-mgmt.php"  aria-current="page">
                                    <img src = "imgs\supplier logo.png" alt = "logo"></img>Suppliers Info Management</a>
                                </li>
                            <?php }  else { ?>
                               
                                <li><a class="sidebar-nav-item" href="#"  aria-current="page">
                                    <img src = "imgs\supplier logo.png" alt = "logo"></img>Suppliers Info Management</a>
                                </li>
                            <?php } 
                            //Accessible by All Levels => Inventory Management
                            ?>
                            <li><a class="sidebar-nav-item" href="view-inventory-mgmt.php"  aria-current="page">
                                <img src = "imgs\inventory mgmt.jpg" alt = "logo"></img> Inventory Management</a>
                            </li>
                            <?php 
                            //Accessible by All Levels => Customer Management
                            ?>
                            <li><a class="sidebar-nav-item" href="view-customer-mgmt.php"  aria-current="page">
                                <img src = "imgs\user profile.png" alt = "logo"></img>Customer Info Management</a>
                            </li>
                            <?php 
                            //Accessible by All Levels => Sale Management
                            ?>
                            <li><a class="sidebar-nav-item" href="view-sale-mgmt.php"  aria-current="page">
                                <img src = "imgs\sale mgmt.png" alt = "logo"></img>Sale Management</a>
                            </li>

                            <?php //only STRATEGIC and Tactical level employee accounts can access into Report sectors...
                            if($accessLevel != "Operational"){ ?>
                            <li><a class="sidebar-nav-item" href="report-dashboard.php"  aria-current="page">
                                <img src = "imgs\report.png" alt = "logo"></img>Reporting</a>
                            </li>
                            <?php } else { ?>
                            <li><a class="sidebar-nav-item" href="#"  aria-current="page">
                                <img src = "imgs\report.png" alt = "logo"></img>Reporting</a>
                            </li>
                            <?php } ?>
                        </ul>            
                    </div>
                </div>
            </nav>
        </aside> 
        