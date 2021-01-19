<?php
function redirect_to($page) {
    header("Location: {$page}");
}
//------------------------------------------------------------------------------
function sanitize($connection, $input) {
    return htmlentities(mysqli_real_escape_string($connection, $input));
}
//------------------------------------------------------------------------------
function confirm_any_logged_in() {
    if ( !isset($_SESSION['user_id']) ) redirect_to ("index.php");
}
//------------------------------------------------------------------------------
function confirm_owner_logged_in() {
    if ( !isset($_SESSION['user_id']) ) redirect_to ("index.php");
    if ($_SESSION['user_type'] != "owner") redirect_to ("index.php");
}
//------------------------------------------------------------------------------
function confirm_customer_logged_in() {
    if ( !isset($_SESSION['user_id']) ) redirect_to ("index.php");
    if ($_SESSION['user_type'] != "customer") redirect_to ("index.php");
}
//------------------------------------------------------------------------------
function captcha_validation($num1, $num2, $total) {
    global $error;
//Captcha check - $num1 + $num = $total
    if( intval($num1) + intval($num2) == intval($total) ) {
        $error = null;
    }
    else {
        $error = "Captcha value is wrong.";
    }
    return $error;
}

/**function getCustomerData($user_name) {




        $connection = mysqli_connect('localhost', 'wd', 'wdihu') or die("Connection failed");

        //Selecting Database
        $db = mysqli_select_db($connection, "wd_hotelsproject");
        $result = mysqli_query($connection, "SELECT FirstName, LastName, Email, Username, Password, Phone FROM customer where Username = '$user_name' ");
        $row = $result->fetch_array();
            $_SESSION['user_name'] = $row["Username"];
            $_SESSION['FirstName'] = $row["FirstName"];
            $_SESSION['LastName'] = $row["LastName"];
            $_SESSION['Email'] = $row["Email"];
            $_SESSION['Password'] = $row["Password"];
            $_SESSION['Phone'] = $row["Phone"];



**/
