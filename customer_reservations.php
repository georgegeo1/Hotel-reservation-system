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

    <br><br> <h2>Reservations' history</h2>

    <table class="temp-table">
        <tbody>
        <tr>
            <td>Hotel Name</td>
            <td><a href="hotel_main.php" target="_blank"><img src="http://via.placeholder.com/100x100"></a></td>
            <td><a href="hotel_main.php" target="_blank">Hotel Info</a></td>
            <td>From Date</td>
            <td>To Date</td>
            <td>1-bed rooms: 0<br>2-bed rooms: 2</td>
            <td>Total Price</td>
            <td><input type="button" class="btn btn-danger" value="Cancel"></td>
            <td><input type="button" class="btn btn-info" value="Rate"></td>
        </tr>
        </tbody>
    </table>

    <table class="temp-table">
        <tbody>
        <tr>
            <td>Hotel Name</td>
            <td><a href="hotel_main.php" target="_blank"><img src="http://via.placeholder.com/100x100"></a></td>
            <td><a href="hotel_main.php" target="_blank">Hotel Info</a></td>
            <td>From Date</td>
            <td>To Date</td>
            <td>1-bed rooms: 1<br>2-bed rooms: 0</td>
            <td>Total Price</td>
            <td><input type="button" class="btn btn-danger" value="Cancel"></td>
            <td><input type="button" class="btn btn-info" value="Rate"></td>
        </tr>
        </tbody>
    </table>
    </div>
    <div class="col-sm-1 col-md-2"></div>

</div>

<?php include "include/body_end_scripts.php" ?>
</body>

</html>
