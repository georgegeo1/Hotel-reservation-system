<?php
include ("include/functions.php");
session_start();



// Registration
if (isset($_POST['register'])) {
    if (empty($_POST['firstName']) || empty($_POST['lastName']) || empty($_POST['emailInput']) || empty($_POST['Username']) || empty($_POST['passwordInput']) || empty($_POST['phoneNumber']) || $_POST['passwordInput'] != $_POST['confirmPassword'] || captcha_validation($_POST['num1'], $_POST['num2'], $_POST['captcha']) != null ) {
        echo "Check your input";
    } else {

        // https://code.tutsplus.com/tutorials/sanitize-and-validate-data-with-php-filters--net-2595
        // http://php.net/manual/en/filter.filters.sanitize.php
        $FirstName = filter_var($_POST['firstName'], FILTER_SANITIZE_STRING);
        $LastName = filter_var($_POST['lastName'], FILTER_SANITIZE_STRING);
        $Email = filter_var($_POST['emailInput'], FILTER_SANITIZE_EMAIL);
        $Username = filter_var($_POST['Username'], FILTER_SANITIZE_STRING);
        $Password = filter_var($_POST['passwordInput'], FILTER_SANITIZE_STRING);
        // $P = $_POST['confirmPassword'];
        $Phone = filter_var($_POST['phoneNumber'], FILTER_SANITIZE_NUMBER_INT);


        //Complete registration if there are no errors

        //Establishing Connection with server
        $connection = mysqli_connect('localhost', 'wd', 'wdihu') or die("Connection failed");

        //Selecting Database
        $db = mysqli_select_db($connection, "wd_hotelsproject");

        $check_email = mysqli_query($connection, "SELECT Email FROM customer where Email = '$Email' ");
        $check_username = mysqli_query($connection, "SELECT Username FROM customer where Username = '$Username' ");
        if(mysqli_num_rows($check_email) > 0){
            echo('Email already exists');}
        elseif (mysqli_num_rows($check_username) > 0){
            echo('Username already exists'); }

        // https://stackoverflow.com/questions/20296777/trying-to-check-if-username-already-exists-in-mysql-database-using-php
       else {

           $query = "INSERT INTO customer (FirstName, LastName, Email, Username, Password, Phone) VALUES('$FirstName', '$LastName', '$Email', '$Username', '$Password', '$Phone')";

            if ($connection->query($query) === TRUE) {
                echo "New record created successfully";
                header('location: index.php');
            }

            else {
                echo "Error";
                $connection->close();
            }
        }
    }

}
     
    
		
	


?>