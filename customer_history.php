<?php
session_start();
include ("include/head.php");
include ("include/owner_navbar.php");
require_once ("include/head.php"); ?>



<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</head>
<body>

<script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
    return;
    }
    else {
        if (window.XMLHttpRequest) {
// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
// code for IE6, IE5
            //https://www.w3schools.com/php/php_ajax_database.asp
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
            xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
    }
        };
        xmlhttp.open("GET","include/getuser.php?q="+str,true);
        xmlhttp.send();
    }
    }
</script>

<div class="page-header" align="center">

        <select name="customer" onchange="showUser(this.value)">
            <option value="" selected="selected">Select customer username</option>
            <?php
            $connection = mysqli_connect('localhost', 'wd', 'wdihu') or die("Connection failed");
            $db = mysqli_select_db($connection, "wd_hotelsproject");
            $sql = "SELECT Customer_ID, Username FROM reservation LIMIT 100";
            $resultset = mysqli_query($connection, $sql) or die("database error:". mysqli_error($connection));

            while( $rows = mysqli_fetch_assoc($resultset) ) {
                ?>
                <option value="<?php echo $rows["Customer_ID"]; ?>"><?php echo $rows["Username"]; ?></option>
            <?php } ?>
        </select>
    </h3>
</div>

<div id="txtHint"><b>Customer details...</b></div>

</body>

</html>



