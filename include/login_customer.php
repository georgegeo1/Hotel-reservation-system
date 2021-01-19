<?php

session_start();
if(isset($_POST['customer_submit'])){

 if(empty($_POST['username']) || empty($_POST['password'])){
 
 $error = "Username or Password is Invalid";
 }
 else
 {
 $username=$_POST['username'];
 $password=$_POST['password'];
 //Establishing Connection with server 
 $connection = mysqli_connect('localhost', 'wd', 'wdihu') or die("Connection failed");

 //Selecting Database
  $dbselected = mysqli_select_db($connection, "wd_hotelsproject");
 //sql query to fetch information
 $query = "Select * FROM customer WHERE Email = '".$username."' and Password = '". $password ."'";
 $result = mysqli_query($connection,$query) or die(mysql_error());
 $rows = mysqli_num_rows($result);
  if($rows==1){                      //Authentication
	$_SESSION['username'] = $username;         
	    header("Location: customer_search.php");
         }
 else
 {
 echo "Username or Password is Invalid";
 }
 mysqli_close($connection); // Closing connection
 }
}
 
?>