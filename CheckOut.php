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
    height: 120px;
    font-size: 10px;
    color: white;
    clear: both;
}            
            
</style>
    <title>Checkout</title>
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
    
    
    <div class="container">
            <?php
        
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "S17114146";
    if(isset($_COOKIE['CURRUSER'])){
        $User_ID = $_COOKIE['CURRUSER'];
    } else {
        $User_ID = 0;
    }
    if(isset($_COOKIE['BASKET'])){
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_errno) {
        die("Connection failed: " . $conn->connect_error);
        exit();
    }        
    $total = 0;    
    $Basket = json_decode($_COOKIE['BASKET']);
    Echo "<strong>Basket:</strong>";
        ?>
            <div class="row">
                <div class="col-md-2">
                    Product
                </div>
                <div class="col-md-2">
                    Price
                </div>
                <div class="col-md-2">
                    Size
                </div>
            </div>
            <br>

            <?php
    foreach ($Basket as $Value){
        $Values = explode(" ", $Value);
        $sql = 'SELECT * FROM `products` WHERE `Product_ID` = '.$Values[0];
        $result = $conn->query($sql);
        while($row =$result->fetch_assoc()) {
        $total += $row["Price"];
    ?>
            <div class="row">
                <div class="col-md-2">
                    <?= $row["Name"];?>
                </div>
                <div class="col-md-2">
                    £
                    <?= $row["Price"];?>
                </div>
                <div class="col-md-2">
                    <?= $Values[1];?>
                </div>
            </div>


            <?php
            
    }  
    }
        echo "<br>Total : £".$total;
        ?>
            <br>
        <form name="postm" method="post" action=<?=$_SERVER['PHP_SELF'];?>>
            <input type="submit" value="Check Out" name="Checkout"><br>
            <?php
            if(isset($_COOKIE['CURRUSER'])){
                $sql = "SELECT `Name`, `Address`, `PostCode` FROM `customers` WHERE `Customer_ID` = ".$User_ID;
                $result = $conn->query($sql);
                while($row =$result->fetch_assoc()) {
                    echo "<br>Current Delivery details: <br>";
                    echo $row["Name"]."<br>";
                    echo $row["Address"]."<br>";
                    echo $row["PostCode"]."<br><br>";
                }
            ?>
            
            
           Change delivery details: <input type="checkbox" name="ChangeDelivery" value="DiffAddress"><br>
            <?php
            } else{
                echo 'Delivery Address details<br>';
            }
        ?>
            Name:<br>
            <input type="text" name="DName" value=""><br>
            Address:<br>
            <input type="text" name="DAddress" value=""><br>
            Postcode:<br>
            <input type="text" name="DPostcode" value=""><br>
        </form>
        <?php
    } else {
        if(isset($_COOKIE['RecentPurchase'])){
            echo "Your order has been placed successfully, Your order number is: ". $_COOKIE['RecentPurchase'].". Please wait before attempting to make another purchase.";
        } else {
        echo "There is nothing currently In your basket, If you would like to add something to your basket click the products tab at the top.";
        }
    }
    ?>

        <script>
            function ClearBasket() {
                var now = new Date();
                var time = now.getTime();
                now.setTime(time);
                var expirey = now.toGMTString();
                document.cookie = 'BASKET = "Empty" ; expires = ' + expirey;
            }

            function RecentPurchase(orderID) {
                var now = new Date();
                var time = now.getTime();
                var expireTime = time + 60000;
                now.setTime(expireTime);
                var expirey = now.toGMTString();
                document.cookie = 'RecentPurchase =' + orderID + ' ; expires = ' + expirey;
            }

        </script>



        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_errno) {
        die("Connection failed: " . $conn->connect_error);
        exit();
    }
    if ($User_ID > 0){ //If user logged in
        if (isset($_POST['ChangeDelivery'])){ //If no user logged in and wanting to change teir delivery address
            $Delivery_Address = $_POST['DAddress'];
            $Delivery_Postcode = $_POST['DPostcode'];
            $Delivery_Name = $_POST['DName'];
        } else { //If user logged in and not wanting to change their delivery address
            $sql = "SELECT `Name`, `Address`, `PostCode` FROM `customers` WHERE `Customer_ID` = ".$User_ID;
            $result = $conn->query($sql);
            while($row =$result->fetch_assoc()) {
                $Delivery_Address = $row["Address"];
                $Delivery_Postcode = $row["PostCode"];
                $Delivery_Name = $row["Name"];
            }
        }
    } else {//If not user logged in use the textboxes
        $Delivery_Address = $_POST['DAddress'];
        $Delivery_Postcode = $_POST['DPostcode'];
        $Delivery_Name = $_POST['DName'];
    }
    $sql = "INSERT INTO `orders` (`Order_ID`, `Customer_ID`, `Deliver_Address`, `Delivery_Postcode`, `Delivery_Name`) VALUES (NULL, '$User_ID', '$Delivery_Address', '$Delivery_Postcode', '$Delivery_Name')";
    $conn->query($sql); 
    $OrderNumber = mysqli_insert_id($conn);
    $Basket = json_decode($_COOKIE['BASKET']);
    foreach ($Basket as $Value){
        $Values = explode(" ", $Value);
        $sql = "INSERT INTO `order line` (`Order_ID`, `Product_ID`, `Size`) VALUES (". $OrderNumber.",".$Values[0].",'".$Values[1]."')";
        $Updatesql = 'UPDATE `stock` SET `Quantity` = `Quantity`-1 WHERE `Product_ID` = '.$Values[0].' AND `Size` = "'.$Values[1].'"'; //Add Validation
        $conn->query($sql);
        $conn->query($Updatesql);
     }
        ?>
        <script type="text/javascript">
            RecentPurchase(<?= $OrderNumber;?>);
            ClearBasket();

        </script>
        <meta http-equiv="refresh" content="0">
        <?php

    }
	?>
    </div>
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
</div> 
</body>

</html>
