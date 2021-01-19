
<?php

//http://www.webslesson.info/2016/10/ajax-with-php-mysql-date-range-search-using-jquery-datepicker.html
session_start();
include ("include/head.php");
include ("include/filter.php");
include ("include/owner_navbar.php");
require_once ("include/head.php");
//Establishing Connection with server
//http://www.webslesson.info/2016/10/ajax-with-php-mysql-date-range-search-using-jquery-datepicker.html
$connection = mysqli_connect('localhost', 'wd', 'wdihu') or die("Connection failed");
$db = mysqli_select_db($connection, "wd_hotelsproject");
$query = "SELECT * FROM reservation ORDER BY Customer_ID desc";
$result = mysqli_query($connection, $query); ?>
<!DOCTYPE html>
<html>
      <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
</head>
<body>
<br /><br />
<div class="container" style="width:900px;">
    <h3 align="center">Search reservation progress</h3><br />
    <div class="col-md-3">
        <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />
    </div>
    <div class="col-md-3">
        <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />
    </div>
    <div class="col-md-5">
        <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />
    </div>
    <div style="clear:both"></div>
    <br />
    <div id="order_table">
        <table class="table table-bordered">
            <tr>
                <th width="15%">Customer ID</th>
                <th width="30%">Room ID</th>
                <th width="43%">Arrival</th>
                <th width="10%">Departure</th>
                <th width="12%">Quantity</th>
                <th width="45%">Request</th>
                <th width="30%">Rating</th>
                <th width="43%">Comments</th>
            </tr>
            <?php
            while($row = mysqli_fetch_array($result))
            {
                ?>
                <tr>
                    <td><?php echo $row["Customer_ID"]; ?></td>
                    <td><?php echo $row["Room_ID"]; ?></td>
                    <td><?php echo $row["Arrival"]; ?></td>
                    <td> <?php echo $row["Departure"]; ?></td>
                    <td><?php echo $row["Quantity"]; ?></td>
                    <td><?php echo $row["Request"]; ?></td>
                    <td> <?php echo $row["Rating"]; ?></td>
                    <td><?php echo $row["Comments"]; ?></td>

                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>

<script>
    $(document).ready(function(){
        $.datepicker.setDefaults({
            dateFormat: 'yy-mm-dd'
        });
        $(function(){
            $("#from_date").datepicker();
            $("#to_date").datepicker();
        });
        $('#filter').click(function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if(from_date != '' && to_date != '')
            {
                $.ajax({
                    url:"include/filter.php",
                    method:"POST",
                    data:{from_date:from_date, to_date:to_date},
                    success:function(data)
                    {
                        $('#order_table').html(data);
                    }
                });
            }
            else
            {
                alert("Please Select Date");
            }
        });
    });
</script>
