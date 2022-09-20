<!DOCTYPE html>
<html>

<head>
    <style>
.footer {
    left: 0;
    bottom: 0;
    position: fixed;
    background-color: #2B2B2B;
    width: 100%;
    font-size: 10px;
    color: white;
}
        
/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
        
table, th, td {
  border: 1px solid black;
}
        
</style>
    <title>Admin Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
        function Logout(){
            var now = new Date();
            now.setTime(now.getTime());
            var expirey = now.toGMTString();
            document.cookie = 'CURRUSER = 0; expires = ' + expirey;
            document.cookie = 'AdminID = 0; expires = ' + expirey;
            }  
    </script>
</head>

<body>
    
    <div class="row">
            <nav class="navbar navbar-expand-xl navbar-light bg-light nav-fill w-100">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="Index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Products.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="CheckOut.php">Checkout</a>
                        </li>
                        <?php 
                         if(isset($_COOKIE['AdminID'])){
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="Admin.php">Admin</a>
                        </li>
                        <?php
                         }
                        ?>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <?php
                        if(!isset($_COOKIE['CURRUSER']) && !isset($_COOKIE['AdminID'])){
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="Account.php">Login/Register</a>
                        </li>
                        <?php
                        } else {
                            ?>
                        <li class="nav-item">
                            <a class="nav-link" href="Account.php">My Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" onclick="Logout()" href="Index.php">logout</a>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </nav>
        </div>    
    <?php
    if(isset($_COOKIE['AdminID'])){
    ?>
    




    <div class="container">

        <div class="tab">
            <button class="tablinks" onclick="ChangeTab(event, 'AddStock')">Add Stock</button>
            <button class="tablinks" onclick="ChangeTab(event, 'ViewStock')">View Stock</button>
            <button class="tablinks" onclick="ChangeTab(event, 'AddItem')">Add Item</button>
            <button class="tablinks" onclick="ChangeTab(event, 'RemoveItem')">Remove Item</button>
            <button class="tablinks" onclick="ChangeTab(event, 'ViewOrders')">View Recent Orders</button>
        </div>

        <div id="AddStock" class="tabcontent">
            <h5>Add Stock</h5><br>
            <form name="postm" method="post" action=<?=$_SERVER['PHP_SELF'];?>>
                Product ID: 
                <select id="DDBProducts" name="DDBProducts">
                    <?php
                    $conn = new mysqli("localhost", "root", "", "S17114146");
                    $sql = "SELECT `Product_ID`,`Name` FROM `products`";
                    $result = $conn->query($sql);
                    while($row =$result->fetch_assoc()) {
                    ?>
                        <option value="<?= $row['Product_ID']?>"><?php echo $row['Product_ID']." - ".$row['Name'] ?></option>
                    <?php
                    }
                        ?>
                    
                </select><br><br>
                Product Size: 
                <select id="DDBSizes" name="DDBSizes">
                    <option value="S">Small</option>
                    <option value="M">Medium</option>
                    <option value="L">Large</option>
                </select><br><br>
                Quantity: 
                    <input type="number" name="StockQuantity" value=""><br>
                    <br><input type="submit" value="Add Stock" name="AddStock">
            </form>
        </div>

        <div id="ViewStock" class="tabcontent">
            <h5>View Stock</h5><br>
            <table>
                    <tr>
                        <td>Product ID</td>
                        <td>Name</td>
                        <td>Product Size</td>
                        <td>Quantity</td>
                    </tr>
                <?php
                $conn = new mysqli("localhost", "root", "", "S17114146");
                $sql = "SELECT products.`Product_ID`,`Name`,`Size`,`Quantity` FROM `stock` JOIN `products` ON products.Product_ID = stock.Product_ID";
                $result = $conn->query($sql);
                while($row =$result->fetch_assoc()) {
                ?>
                
                    <tr>
                        <td>
                            <?= $row['Product_ID']?>
                        </td>
                        <td>
                            <?= $row['Name']?>
                        </td>
                        <td>
                            <?= $row['Size']?>
                        </td>
                        <td>
                            <?= $row['Quantity']?>
                        </td>
                    </tr>
                 <?php
                } 
                ?>   
                </table>
        </div>

        <div id="AddItem" class="tabcontent">
            <form name="postm" method="post" action=<?=$_SERVER['PHP_SELF'];?>>
                <h5>Add New Item</h5><br>
                Product Name:<br>
                <input type="text" name="PName" value=""><br>
                Price:<br>
                <input type="number" step="0.01" name="PPrice" value=""><br>
                Description:<br>
                <input type="text" name="PDescription" value=""><br>
                Image (.jpg or .png link):<br>
                <input type="text" name="PImage" value=""><br><br>
                <input type="submit" value="AddItem" name="AddItem">
            </form>
        </div>
              
        <div id="RemoveItem" class="tabcontent">
            <h5>Remove Item</h5><br>
            <form name="postm" method="post" action=<?=$_SERVER['PHP_SELF'];?>>
                Product ID: 
                <select id="RemoveItemProducts" name="RemoveItemProducts">
                    <?php
                    $conn = new mysqli("localhost", "root", "", "S17114146");
                    $sql = "SELECT `Product_ID`,`Name` FROM `products`";
                    $result = $conn->query($sql);
                    while($row =$result->fetch_assoc()) {
                    ?>
                        <option value="<?= $row['Product_ID']?>"><?php echo $row['Product_ID']." - ".$row['Name'] ?></option>
                    <?php
                    }
                        ?>
                    
                </select><br><br>
                I am confirming that I want to delete this product and that this cannot be undone <input type="checkbox" name="DeleteConfirmation" value="DeleteConfirmation">
                <br><input type="submit" value="Delete Item" name="AddStock">
            </form>
        </div>

        <div id="ViewOrders" class="tabcontent">
            <h5>View Recent Orders</h5><br>
            <table>
                    <tr>
                        <td>Order ID</td>
                        <td>Delivery Name</td>
                        <td>Delivery Address</td>
                        <td>Delivery Postcode</td>
                    </tr>
            <?php
                $conn = new mysqli("localhost", "root", "", "S17114146");
                $sqlOrder = "SELECT * FROM `orders` ORDER BY `Order_ID` DESC LIMIT 3";
                $resultOrder = $conn->query($sqlOrder);
                while($row =$resultOrder->fetch_assoc()) {
                ?>
                    <tr>
                        <td>
                            <?= $row['Order_ID'];?>
                        </td>
                        <td>
                            <?= $row['Delivery_Name'];?>
                        </td>
                        <td>
                            <?= $row['Deliver_Address'];?>
                        </td>
                        <td>
                            <?= $row['Delivery_Postcode'];?>
                        </td>
                    </tr>
                <tr><td></td></tr>
                <tr>
                    <td>
                        Product Name
                    </td>
                    <td>
                        Product ID
                    </td>
                    <td>
                        Product Size
                    </td>
                </tr>
                
                                 <?php
                $Linesql = "SELECT `Order_ID`, `order line`.`Product_ID`, `Size`, `products`.`Name` FROM `order line` JOIN `products` ON products.Product_ID = `order line`.Product_ID WHERE `Order_ID` = ".$row['Order_ID'];
                $Lresult = $conn->query($Linesql);
                while($Lrow =$Lresult->fetch_assoc()) {
                    ?>
                <tr>
                    <td>
                        <?= $Lrow['Name']?>
                    </td>
                    <td>
                        <?= $Lrow['Product_ID']?>
                    </td>
                    <td>
                        <?= $Lrow['Size']?>
                    </td>
                </tr>
                <?php
                }
                    ?>
                <tr><td></td></tr>
            <?php
                }
                ?> 
            </table>  
                
        </div>

        <script>
            function ChangeTab(evt, cityName) {
                document.getElementsByName("StockQuantity")[0].value = "";
                document.getElementsByName("PName")[0].value = "";
                document.getElementsByName("PPrice")[0].value = "";
                document.getElementsByName("PDescription")[0].value = "";
                document.getElementsByName("PImage")[0].value = "";
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " active";
            }

        </script>


    </div>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_reporting(0);    
 	$conn = new mysqli("localhost", "root", "", "S17114146");
    // Check connection
    if ($conn->connect_errno) {
        die("Connection failed: " . $conn->connect_error);
        exit();
    }
    if ($_POST['StockQuantity'] != ""){
        $Updatesql = 'UPDATE `stock` SET `Quantity` = `Quantity`+'.$_POST['StockQuantity'].' WHERE `Product_ID` = "'.$_POST['DDBProducts'].'" AND `Size` = "'.$_POST['DDBSizes'].'"'; //Add Validation
        $conn->query($Updatesql);    
    } else if ($_POST['PName'] != "" && $_POST['PPrice'] != "" && $_POST['PDescription'] != "" && $_POST['PImage'] != ""){
        $sql = "INSERT INTO `Products` (`Product_ID`, `Name`, `Price`, `Description`, `Image`) VALUES (NULL, '".$_POST['PName']."', '".$_POST['PPrice']."', '".$_POST['PDescription']."', '".$_POST['PImage']."')";
        $conn->query($sql);
        $Product_ID = mysqli_insert_id($conn);
        $sql = "INSERT INTO `Stock` (`Q_Index`, `Product_ID`, `Quantity`, `Size`) VALUES (NULL, '".$Product_ID."', 0 , 'S'), (NULL, '".$Product_ID."', 0 , 'M'), (NULL, '".$Product_ID."', 0 , 'L')";
        $conn->query($sql);
    } else if (isset($_POST['DeleteConfirmation'])){
        $Deletesql = 'DELETE FROM `stock` WHERE `Product_ID` = '.$_POST['RemoveItemProducts'];
        $conn->query($Deletesql);
        $Deletesql = 'DELETE FROM `products` WHERE `Product_ID` = '.$_POST['RemoveItemProducts'];
        $conn->query($Deletesql);
    }
        ?>
    <meta http-equiv="refresh" content="0">
    <?php
    }
	?>


    <div class="footer">
        <br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-3">
                    <a href="Index.php" style="color: white">Home Page</a><br>
                    <a href="Account.php" style="color: white">Register/Login/My Profile</a>
                </div>
                <div class="col-md-3">
                    <a href="CheckOut.php" style="color: white">Check Out</a><br>
                    <a href="Products.php" style="color: white">Products</a>
                </div>
            </div>
        </div>
        <br><br><br>
    </div>
<?php
    } else {
        echo "You do not have permission to view this page, Please login and try again.";
    }
    ?>
    
</body>

</html>