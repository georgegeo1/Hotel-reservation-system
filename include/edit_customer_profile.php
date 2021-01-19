<?php


$connection = mysqli_connect('localhost', 'wd', 'wdihu') or die("Connection failed");
$db = mysqli_select_db($connection, "wd_hotelsproject");

if (isset($_POST['submit'])) {

   $a = $_POST['FirstName'];
   $b = $_POST['LastName'];
   $c = $_POST['Username'];
   $d = $_POST['Email'];
   $e = $_POST['Phone'];
   $f = $_POST['OldPassword'];
   $g = $_POST['NewPassword'];



    if (empty($_POST['FirstName']==FALSE)) {

        $result1 = mysqli_query($connection, "UPDATE customer SET firstName = '$a' WHERE Username = '$c';") or die(mysqli_error());
    }


    if (empty($_POST['LastName']==FALSE)) {
        $result2 = mysqli_query($connection, "UPDATE customer SET lastName = '$b' WHERE Username = '$c';") or die(mysqli_error());
    }

    if (empty($_POST['Username']==FALSE)) {
        $result3 = mysqli_query($connection, "UPDATE customer SET Username = '$c' WHERE Username = '$c';") or die(mysqli_error());
    }

    if (empty($_POST['Email']==FALSE)) {
        $result4 = mysqli_query($connection, "UPDATE customer SET Email = '$d' WHERE Usename = '$c';") or die(mysqli_error());
    }

    if (empty($_POST['Phone']==FALSE)) {
        $result5 = mysqli_query($connection, "UPDATE customer SET Phone = '$e' WHERE Usename = '$c';") or die(mysqli_error());
    }

    if ((empty($_POST['NewPassword']==FALSE) && $f==$g)) {
        $result6 = mysqli_query($connection, "UPDATE customer SET Password = '$g' WHERE Usename = '$c';") or die(mysqli_error());
    }

}


if (isset($_POST['cancel'])) {

    $_POST['firstName'] = "";
    $_POST['LastName'] = "";
    $_POST['Username'] = "";
    $_POST['Email'] = "";
    $_POST['Phone'] = "";
    $_POST['OldPassword'] = "";
    $_POST['NewPassword'] = "";

}







$connection->close();







?>