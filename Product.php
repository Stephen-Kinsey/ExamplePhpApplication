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
    color: white
}
    
img {
    max-width: 100%;
    height: auto;
    width: auto\9; /* ie8 */
}
</style>
  <meta charset="utf-8">
  <title>Product</title>
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

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_errno) {
        die("Connection failed: " . $conn->connect_error);
        exit();
    }


    $sql = 'SELECT * FROM `products` WHERE `Product_ID` = '.$_GET['ID']." limit 1";
    $result = $conn->query($sql);

    if ($result) {
        // output data of each row
?>
        
        <div class="row"><div class="col-md-2"> </div></div>
<div class="row">
        <?php
        while($row =$result->fetch_assoc()) {
            $ProductId = $row["Product_ID"];
    ?>
    <div class="col-md-2"></div>
    <div class="col-md-4"><img src="<?= $row["Image"];?>" style="width:100%"></div>
    <div class="col-md-2">
        <br>
        <h5><?= $row["Name"];?></h5>
        <strong><font color="red">£<?= $row["Price"];?></font></strong><br><br>
        <?= $row["Description"];?><br><br>
        Sizes:    
        <select id="DDBSizes">
            
            <?php
        } 
    $sql = "SELECT * FROM `Stock` WHERE `Product_ID` = ".$_GET['ID']." AND `Quantity` > 0";
    $result = $conn->query($sql);
        if (mysqli_num_rows($result)==0){
            ?>
            <option value="null">No Stock Available</option>
            <?php
        }
        while($Srow =$result->fetch_assoc()) {
            if (intval($Srow["Quantity"]) > 0){ 
                $a = $Srow["Size"];
        ?>

            <option value=$a>
                <?= $Srow["Size"];?>
            </option>
            <?php
            }
        ?>

            <?php    
        
        }
            ?>
        </select><br><br>

        <button onclick="addToBasket()">Add To Basket</button><br><br>
        
        <h6>Reviews</h6>
            <div style="height:120px;width:300px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
                <?php
                $sql = "SELECT `Review`,`ReviewDate` FROM reviews WHERE `Product_ID` = ".$_GET['ID'];
                $result = $conn->query($sql);
                while($row =$result->fetch_assoc()) {
        ?>
                <?= $row["ReviewDate"];?><br>
                <?= $row["Review"];?><br><br>
                <?php 
                }
        ?>
            </div>
        <br>
        <form name="postm" method="post" action=<?=$_SERVER['PHP_SELF']."?ID=".$_GET['ID'];?>>
        <input type="text" name="Review" value="" style="height:80px;width:300px"><br><br>
        <input type="submit" value="Add review" name="AddStock">
        </form>
        
        </div>
        <script>
            function getCookie(cname) {
                var name = cname + "=";
                var decodedCookie = decodeURIComponent(document.cookie);
                var ca = decodedCookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            }

            function addToBasket() {
                var e = document.getElementById("DDBSizes"); //Gets the select box value
                var strUser = e.options[e.selectedIndex].text;
                var now = new Date();
                var time = now.getTime();
                var expireTime = time + 1800000; //Half an hour
                now.setTime(expireTime);
                var expirey = now.toGMTString();
                if (document.cookie.indexOf("BASKET=") >= 0) {
                    var tBasket = JSON.parse(getCookie("BASKET"));
                    var val = <?= $ProductId;?> + " " + strUser;
                    tBasket.push(val);
                    var ary = JSON.stringify(tBasket);
                    document.cookie = 'BASKET=' + ary + '; expires=' + expirey;
                } else {
                    var val = <?= $ProductId;?> + " " + strUser;
                    var tBasket = [val];
                    var ary = JSON.stringify(tBasket);
                    document.cookie = "BASKET=" + ary + "; expires=" + expirey;
                }
            }

        </script> 
        
        </div>
        <?php
     } else {
   ?>

        <p>Product not found</p>



<?php
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check connection
    if ($conn->connect_errno) {
        die("Connection failed: " . $conn->connect_error);
        exit();
    }
    if (strlen($_POST['Review']) > 25){
        $date = date("Y/m/d");
        $sql = "INSERT INTO `reviews` (`Review_ID`, `Product_ID`, `ReviewDate`, `Review`) VALUES (NULL, ".$_GET['ID'].", CAST('". $date ."' AS DATE), '".$_POST['Review']."')";
        $conn->query($sql);
    } else { 
        echo "<script type='text/javascript'>alert('Your review must be atleast 25 characters long.');</script>";
    }
    
    ?>
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
    <br><br><br>
</div>    
    
</body>

</html>
