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
</style>
    <meta charset="utf-8">
    <title>Products</title>
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
                        <li>
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


    $sql = 'SELECT * FROM `products`';
    $result = $conn->query($sql);

    if ($result) {
        // output data of each row
?>
        <div class="row">
            <?php
        $rowCount = 0;
        while($row =$result->fetch_assoc()) {
            $ProductId = $row["Product_ID"];
    ?>

            <div class="col-md-2">
                <a href="Product.php?ID=<?= $row["Product_ID"];?>">
                    <img src="<?= $row["Image"];?>" style="width:150px;height:200px";>
                </a>
            </div>
            <div class="col-md-2">
                <?= $row["Name"];?><br>
                £
                <?= $row["Price"];?><br>
                <?= $row["Description"];?><br>
            </div>
            <?php
    $rowCount++;
    if($rowCount % 3 == 0) echo '</div><div class="row">';
        } ?>
        </div>
        <?php
     } else {
   ?>

        <p>0 results</p>



        <?php
    }
    $conn->close();
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
