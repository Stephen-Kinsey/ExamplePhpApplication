<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
.footer {
    left: 0;
    bottom: 0;
    position: relative;
    background-color: #2B2B2B;
    width: 100%;
    font-size: 10px;
    color: white;
}
 
table, th, td {
  border: 1px solid black;
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
</style>
    <script>
        function Logout(){
            var now = new Date();
            now.setTime(now.getTime());
            var expirey = now.toGMTString();
            document.cookie = 'CURRUSER = 0; expires = ' + expirey;
            document.cookie = 'AdminID = 0; expires = ' + expirey;
            } 
                    
        function ChangeTab(evt, cityName) {
            try{
            document.getElementsByName("LEmail")[0].value = "";
            document.getElementsByName("LPassword")[0].value = "";
            document.getElementsByName("SEmail")[0].value = "";
            document.getElementsByName("SPassword")[0].value = "";
            document.getElementsByName("REmail")[0].value = "";
            document.getElementsByName("RPassword")[0].value = "";
            document.getElementsByName("RName")[0].value = "";
            document.getElementsByName("RAddress")[0].value = "";
            document.getElementsByName("RPostcode")[0].value = "";
            } catch (err){
            document.getElementsByName("CName")[0].value = "";
            document.getElementsByName("CPostcode")[0].value = "";
            document.getElementsByName("CAddress")[0].value = "";
            document.getElementsByName("CEmail")[0].value = "";
            document.getElementsByName("ConfPassword")[0].value = "";
            document.getElementsByName("OldPassword")[0].value = "";
            document.getElementsByName("NewPassword")[0].value = "";
            document.getElementsByName("ConfNewPassword")[0].value = ""; 
            }
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
            
        function MakeCookie(CookieType, val){
            var now = new Date();
            var time = now.getTime();
            var expireTime = time + 1800000; //Half an hour
            now.setTime(expireTime);
            var expirey = now.toGMTString();
            document.cookie = CookieType + ' = ' + val + '; expires = ' + expirey; 
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
    if(!isset($_COOKIE['CURRUSER']) && !isset($_COOKIE['AdminID'])){
        ?>

        <h2>Register/Login</h2>

        <div class="tab">
            <button class="tablinks" onclick="ChangeTab(event, 'Login')">Login</button>
            <button class="tablinks" onclick="ChangeTab(event, 'Register')">Register</button>
            <button class="tablinks" onclick="ChangeTab(event, 'StaffLogin')">Staff Login</button>
        </div>

        <div id="Login" class="tabcontent">
            <form name="postm" method="post" action=<?=$_SERVER['PHP_SELF'];?>>
                <h5>Login</h5><br>
                Email Address:<br>
                <input type="text" name="LEmail" value=""><br>
                Password:<br>
                <input type="password" name="LPassword" value=""><br>
                <input type="submit" value="Login" name="SLogin">
            </form>
        </div>

        <div id="StaffLogin" class="tabcontent">
            <form name="postm" method="post" action=<?=$_SERVER['PHP_SELF'];?>>
                <h5>Staff Login</h5><br>
                Email Address:<br>
                <input type="text" name="SEmail" value=""><br>
                Password:<br>
                <input type="password" name="SPassword" value=""><br>
                <input type="submit" value="Login" name="StaffLogin">
            </form>
        </div>

        <div id="Register" class="tabcontent">
            <form name="postm" method="post" action=<?=$_SERVER['PHP_SELF'];?>>
                <h5>Register</h5><br>
                Email Address:<br>
                <input type="text" name="REmail" value=""><br>
                Password:<br>
                <input type="text" name="RPassword" value=""><br>
                Name:<br>
                <input type="text" name="RName" value=""><br>
                Address:<br>
                <input type="text" name="RAddress" value=""><br>
                Postcode:<br>
                <input type="text" name="RPostcode" value=""><br>
                <input type="submit" value="Register" name="SRegister"><br>
            </form>
        </div>

        <?php
    } else {
        ?>

        <h2>Profile</h2>

        <div class="tab">
            <button class="tablinks" onclick="ChangeTab(event, 'ViewDetails')">View/Change my details</button>
            <button class="tablinks" onclick="ChangeTab(event, 'ChangePassword')">Change Password</button>
            <button class="tablinks" onclick="ChangeTab(event, 'viewHistory')">View my order history</button>
        </div>

        <div id="viewHistory" class="tabcontent">

            <h5>View Recent Orders</h5><br>
            <table>
                <tr>
                    <td>Order ID</td>
                    <td>Product Name</td>
                    <td>Product ID</td>
                    <td>Product Size</td>
                </tr>
                <?php
                $User_ID = $_COOKIE['CURRUSER'];
                $conn = new mysqli("localhost", "root", "", "S17114146");
                $sqlOrder = "SELECT * FROM `orders` WHERE `Customer_ID` = ".$User_ID." ORDER BY `Order_ID` DESC LIMIT 3";
                $resultOrder = $conn->query($sqlOrder);
                while($row =$resultOrder->fetch_assoc()) {
                ?>
                <tr>
                    <td>
                        <?= $row['Order_ID'];?>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>


                <?php
                $Linesql = "SELECT `Order_ID`, `order line`.`Product_ID`, `Size`, `products`.`Name` FROM `order line` JOIN `products` ON products.Product_ID = `order line`.Product_ID WHERE `Order_ID` = ".$row['Order_ID'];
                $Lresult = $conn->query($Linesql);
                while($Lrow =$Lresult->fetch_assoc()) {
                    ?>
                <tr>
                    <td></td>
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
                <tr>
                    <td></td>
                </tr>
                <?php
                }
                ?>
            </table>

        </div>

        <div id="ViewDetails" class="tabcontent">
            <form name="postm" method="post" action=<?=$_SERVER['PHP_SELF'];?>>
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

    $User_ID = $_COOKIE['CURRUSER'];
    $sql = 'SELECT * FROM `customers` WHERE `Customer_ID` ='.$User_ID." limit 1";
    $result = $conn->query($sql);
    if ($result) {
        while($Srow =$result->fetch_assoc()) {
        ?>

                <div class="row">
                    <div class="col-md-2">
                        <strong>
                            Customer ID: <br><br>
                            Name : <br><br>
                            Address : <br><br>
                            Postcode : <br><br>
                            Email : <br><br><br>
                        </strong>
                    </div>
                    <div class="col-md-2">
                        <?= $Srow["Customer_ID"];?><br><br>
                        <?= $Srow["Name"];?><br><br>
                        <?= $Srow["Address"];?><br><br>
                        <?= $Srow["PostCode"];?><br><br>
                        <?= $Srow["Email"];?><br><br><br>
                    </div>
                    <div class="col-md-2">
                        <br><br>
                        <input type="text" name="CName" value="" style="height:25px"><br><br>
                        <input type="text" name="CAddress" value="" style="height:25px"><br><br>
                        <input type="text" name="CPostcode" value="" style="height:25px"><br><br>
                        <input type="text" name="CEmail" value="" style="height:25px"><br><br><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                    <strong>Please confirm by entering your password</strong>
                    </div>
                    <div class="col-md-2">
                        <input type="password" name="ConfPassword" value="" style="height:25px">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><br><br><input type="submit" value="Change Details" name="ChangeDetails"></div>
                </div>
                <?php       
    }
    }
    ?>
            </form>
        </div>

        <div id="ChangePassword" class="tabcontent">
            <form name="postm" method="post" action=<?=$_SERVER['PHP_SELF'];?>>
                <h5>Change Password</h5><br>
                <div class="row">
                    <div class="col-md-2">
                        Old Password:<br><br>
                        New Password:<br><br>
                        Confirm New Password:<br><br>
                    </div>
                    <div class="col-md-2">
                        <input type="password" name="OldPassword" value="" style="height:25px"><br><br>
                        <input type="password" name="NewPassword" value="" style="height:25px"><br><br>
                        <input type="password" name="ConfNewPassword" value="" style="height:25px"><br><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-2">
                        <input type="submit" value="Confirm" name="Confirm">
                    </div>
                </div>
            </form>
        </div>

        <?php       
    }
    ?>



        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $salt = "saltySalter";
    error_reporting(0);    
 	$conn = new mysqli("localhost", "root", "", "S17114146");
    // Check connection
    if ($conn->connect_errno) {
        die("Connection failed: " . $conn->connect_error);
        exit();
    }
    if ($_POST['LEmail'] != "" && $_POST['LPassword'] != ""){
        $EnPassword = crypt($_POST['LPassword'],$salt);
        $email = $_POST['LEmail'];
        $sql = "SELECT `Customer_ID` FROM `customers` WHERE `Password` = '".$EnPassword."' AND `Email` = '$email'";
        $result = $conn->query($sql);
        $count = mysqli_num_rows($result);
        if ($count == 1){
            while($row =$result->fetch_assoc()) {
            $ID = $row["Customer_ID"];
            }
            ?>
        <script type="text/javascript">
            MakeCookie('CURRUSER', <?= $ID ?>);

        </script>

        <?php
        } else {
            echo "<script type='text/javascript'>alert('Password Incorrect');</script>";
        }

        
    } else if ($_POST['REmail'] != "" && $_POST['RAddress'] != "" && $_POST['RPostcode'] != "" && $_POST['RPassword'] != "" && $_POST['RName'] != "") {
        $EnPassword = crypt($_POST['RPassword'],$salt);
        $sql = "INSERT INTO `customers` (`Customer_ID`, `Name`, `Address`, `PostCode`, `Email`, `Password`) VALUES (NULL, '".$_POST['RName']."', '".$_POST['RAddress']."', '".$_POST['RPostcode']."', '".$_POST['REmail']."', '".$EnPassword."')";
        $conn->query($sql);
        $Customer_number = mysqli_insert_id($conn);
        ?>
        <script type="text/javascript">
            MakeCookie('CURRUSER', <?= $Customer_number ?>);

        </script>
        <?php
    } else if ($_POST['SEmail'] != "" && $_POST['SPassword'] != ""){
        $EnPassword = crypt($_POST['SPassword'],$salt);
        $email = $_POST['SEmail'];
        $sql = "SELECT `Staff_ID` FROM `staff` WHERE `Password` = '".$EnPassword."' AND `Email` = '$email'";
        $result = $conn->query($sql);
        $count = mysqli_num_rows($result);
        if ($count == 1){
            while($row =$result->fetch_assoc()) {
            $ID = $row["Staff_ID"];
            }
            ?>
        <script type="text/javascript">
            MakeCookie('AdminID', <?= $ID ?>);

        </script>
        <?php
        } else {
            echo "<script type='text/javascript'>alert('Password Incorrect');</script>";
        }
    }else if (($_POST['CName'] != '' || $_POST['CAddress'] != '' || $_POST['CPostcode'] != '' || $_POST['CEmail'] != '') && $_POST['ConfPassword'] != ''){
        $EnPassword = crypt($_POST['ConfPassword'],$salt);
        $sql = "SELECT * FROM `customers` WHERE `Customer_ID` = $User_ID AND `Password` = '".$EnPassword."'";
        $result = $conn->query($sql);
        $count = mysqli_num_rows($result);
        if ($count == 1){
            $sql = "UPDATE `customers` SET ";
            if ($_POST['CName'] != ''){
                $sql .= "`Name` = '".$_POST['CName']."',";
            }
            if ($_POST['CAddress'] != ''){
                $sql .= "`Address` = '".$_POST['CAddress']."',";
            }
            if ($_POST['CPostcode'] != ''){
                $sql .= "`PostCode` = '".$_POST['CPostcode']."',";
            }
            if ($_POST['CEmail'] != ''){
                $sql .= "`Email` = '".$_POST['CEmail']."',";
            }
            $sql = substr($sql, 0, -1);
            $sql .= " WHERE `Customer_ID` = $User_ID";
            $conn->query($sql);
            echo "<script type='text/javascript'>alert('your details have been successfully updated');</script>";
        } else{
            echo "<script type='text/javascript'>alert('Password Incorrect');</script>";
        }
        
        } else if ($_POST['OldPassword'] != '' && $_POST['NewPassword'] != '' && $_POST['ConfNewPassword'] != '' && $_POST['ConfNewPassword'] == $_POST['NewPassword']) {
        $EnPassword = crypt($_POST['OldPassword'],$salt);
        $sql = "SELECT * FROM `customers` WHERE `Customer_ID` = $User_ID AND `Password` = '".$EnPassword."'";
        $result = $conn->query($sql);
        $count = mysqli_num_rows($result);
        if ($count == 1){
            $NewEnPassword = crypt($_POST['NewPassword'],$salt);
            $sql = "UPDATE `customers` SET `Password` = '$NewEnPassword' WHERE `Customer_ID` = $User_ID";
            $conn->query($sql);
            echo "<script type='text/javascript'>alert('Your password has been changed successfully');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Incorrect Password');</script>";
        }
    } else {
        echo "One or more of the fields are empty please fill them and try again.";
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
