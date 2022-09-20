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
    <title>Home</title>
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

    <br>
        <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12">
            <a href="Products.php">
            <img src="http://media.topman.com/wcsstore/ConsumerDirectStorefrontAssetStore/images/colors/color6/cms/pages/static/static-0000139019/images/WK19_TOPMAN_HP_Desktop_NEW-SEASON_UK.jpg" width = "1080">
            </a>
        </div>
    </div>        

<br>        
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