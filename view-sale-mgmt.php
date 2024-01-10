<?php
    //session_start();
    include("admin/conf/auth.php"); 
    include("admin/conf/config.php");
 
    //$cart variable stores numbers of items added to the cart
    $shoppingcart = 0;
    //when add to cart button is clicked, 
    //session['cart'] is started
    if(isset($_SESSION['shoppingcart'])){
        //session cart are stored in the cart var as product qty.
        foreach($_SESSION['shoppingcart'] as $qty){
            $shoppingcart += $qty;
        }
    }
     
    $employee_assigned_store = $_SESSION['employee_assigned_store'];
    //when user clicks an element "UL" which has class = 'cats'
    if(isset($_GET['cats'])){
        //get category name from where user clicks
        $catName = $_GET['cats'];
        //show all related products where categoryID = cat_id
        $result = "SELECT itemlist.*, inventory.* 
        FROM itemlist
        RIGHT JOIN inventory 
        ON itemlist.itemID = inventory.itemID 
        WHERE itemlist.categoryName = $catName 
        ";

        $items = $conn->query( $result); 
    }else{
        //if not show all products
        $result = "SELECT itemlist.*, inventory.* 
        FROM itemlist
        RIGHT JOIN inventory 
        ON itemlist.itemID = inventory.itemID 
        WHERE inventory.storeNo =  $employee_assigned_store
        ORDER BY itemName";
        $items = $conn->query( $result); 
    }

    ?>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Event listener for capturing barcode input
            document.addEventListener('keydown', function(event) {
                // Assuming the Enter key (key code 13) signifies the end of a barcode scan
                if (event.keyCode === 13) {
                    event.preventDefault(); // Prevent the default behavior (form submission, etc.)
                    
                    // Extract the scanned barcode from the input field
                    var barcode = document.getElementById('barcodeInput').value;
                    
                    // Send the barcode to the server (you can use AJAX for this)
                    // For simplicity, this example just logs the barcode to the console
                    console.log('Scanned Barcode: ' + barcode);
                    
                    // Clear the input field for the next scan
                    document.getElementById('barcodeInput').value = '';
                }
            });
        });
    </script>
    
<!DOCTYPE html>

<html>
    <head>
        <title>Sale Management</title>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Author: May Phyu Sin Thant, PHP POS System. Implemented in February, 2022">
        <link rel = "stylesheet" href = "css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    </head>
        <!--Required CDN: Bootstrap | Popper | Jquery to Work Boostrap Collapse Properly-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>  
         
    <body>
     
        <?php 
        //header is implemented separately
        include("header-navigation.php");
        ?>
               
        <section class = "container mx-auto" >
            <div class = "row mx-0 px-0" >
            <?php include("sidebar.php"); ?>
        
            <main class = "col-lg-8 col-md-8 col-sm-12 col-xs-12 my-0 py-3 mx-auto px-auto ">
                <div class = "row ">
                    <h4 class = "col"> Available Items in Store No : <?php echo $employee_assigned_store?></h4>
                    <span class = "col"> 
                        <a href = "view-sale-records.php" class = "btn btn-dark" type = "button"> See Daily Sales Records </a>
                    </span>
                    <label for="barcodeInput">Scan Barcode:</label>
                    <input type="text" id="barcodeInput" autofocus>
                    <a class = "nav-link" href = "view-cart.php" >
                        <i class="fas fa-shopping-cart " style = "font-size: 24px;"></i> 
                        <span class = "badge bg-danger rounded-pill translate-middle"> (<?php echo $shoppingcart ?>) </span> 
                    </a>


                    <?php foreach( $items as $row ) {?>
                    <div class = "card col-lg-4 col-md-4  col-sm-5 ">
                        <div class = "card-body">
                            <b > <?php echo $row['itemName'] ?></b><br>
                            <img class = "img-resposive img-thumbnail bg-image" alt = "product photo"
                            src = "imgs/<?php echo $row['image']?>"  width = "240" height = auto> 
                            <br>
                            <i><?php echo $row['categoryName']?></i><br>  
                            <i> Description : </i> <b><?php echo $row['description']?></b></br>  
                            <i> Current In Stock  :</i><b><?php echo $row['instockqty'] ?></b></br>
                            <i>Discount : </i><b><?php echo $row['discount'].'%' ?></b></br>
                            <i> Tag Price :</i><b><?php echo $row['tagPrice'] ?></b></br>
                            <i> Store No : </i><b><?php echo $row['storeNo'] ?> </b></br>
                            <i> Purchased Date : </i><b><?php echo $row['purchasedDate'] ?> </b>
                        </div>
                        <div class ="card-footer"> 
                            <a href="add-to-cart.php?id=<?php echo $row['itemID'] ?>"             
                            class="add-to-cart button btn btn-danger" >Add to Cart</a>  
                        </div><hr>
                    </div>
                    <?php } ?>
                </div> 
            </main>
         </div>
        </section>
    </body>
     <footer>
            <p>Copyright  ©2022 Developed by May Phyu Sin Thant </p>
        </footer> 
</html>