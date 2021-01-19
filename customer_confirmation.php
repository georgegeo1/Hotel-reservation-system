<?php
require_once 'include/connect.php';
include "include/head.php";
?>

<body>

<div> ---- userid - Customer Name</div>

<?php
include "include/customer_navbar.php";
?>

<div class="row">
    <div class="col-sm-1 col-md-2"></div>
    <div class="col-sm-10 col-md-8">
        <br><br> <h2>Reservation details</h2>

        <p>Hotel name</p>
        <p>Hotel address</p>
        <p>Hotel contact (email, phone)</p>
        <p>1-bed rooms requested : 0</p>
        <p>2-bed rooms requested : 1</p>
        <h4>Total price: 142 EUR</h4>
        <p>Special Requests:</p>
        <textarea rows="4" cols="50"></textarea>
        <br><input type="button" class="btn btn-primary btn-block" value="Confirm">
    </div>
    <div class="col-sm-1 col-md-2"></div>
</div>

<?php include "include/body_end_scripts.php" ?>
</body>

</html>