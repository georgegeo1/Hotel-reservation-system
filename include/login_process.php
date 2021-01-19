<?php 
session_start();
require_once "connect.php";
require_once "functions.php";

$username = sanitize($connection, $_POST['username']);
$password = sanitize($connection, $_POST['password']);

//echo $password . '  ';
//echo $_POST['action_type'];

if ( $_POST['action_type'] === "login_owner" ) { // if login as hotel owner attempted
    $query = "SELECT id, username, password 
              FROM owner 
              WHERE username = '{$username}'
              LIMIT 1";
    $result = mysqli_query($connection, $query) or die("Find Owner Query failed");
    $numRows = mysqli_num_rows($result);
    if ($numRows == 1) {
        $foundUser = mysqli_fetch_array($result);
        //if ( password_verify($password, $foundUser['password']) ) {
        if ($password === $foundUser['password']) {
            $_SESSION['user_id'] = $foundUser['id'];
            $_SESSION['user_name'] = $foundUser['username'];
            $_SESSION['user_type'] = "owner";
            redirect_to("../owner_home.php");
        } else {
            redirect_to("../index.php");
        }
    } else redirect_to("../index.php");
} // end if owner

if ( $_POST['action_type'] === "login_customer" ) { // if login as customer attempted
    $query = "SELECT id, username, password 
              FROM customer 
              WHERE username = '{$username}'
              LIMIT 1";
    $result = mysqli_query($connection, $query) or die("Find Customer Query failed");
    $numRows = mysqli_num_rows($result);
    if ($numRows == 1) {
        $foundUser = mysqli_fetch_array($result);
        //if ( password_verify($password, $foundUser['password']) ) {
        if ($password === $foundUser['password']) {
            $_SESSION['user_id'] = $foundUser['id'];
            $_SESSION['user_name'] = $foundUser['username'];
            $_SESSION['user_type'] = "customer";
            redirect_to("../customer_search.php");
        } else {
            redirect_to("../index.php");
        }
    } else redirect_to("../index.php");
} // end if customer


