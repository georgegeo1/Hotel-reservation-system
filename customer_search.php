<?php
session_start();
require_once "include/head.php";
require_once "include/functions.php";
confirm_customer_logged_in();

$user_id = $_SESSION['user_id'];
require_once "include/head.php";
?>

<!--
see http://antenna.io/demo/jquery-bar-rating/examples/
and https://github.com/antennaio/jquery-bar-rating
 -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/fontawesome-stars.css" />
<link rel="stylesheet" type="text/css" href="css/bars-square.css" />

<body>
<div class="container">

<?php include "include/customer_navbar.php"; ?>

<form id="search_form" onsubmit="process_search_button();">
    <!-- select country and city -->
    <br>
    <div class="row">
        <div class="col-lg-4 col-sm-6">
            Select country: <!-- country drop-down -->
            <select id="country_id" name="country_id" required
                    onload="populateCities(this.value)"
                    onchange="populateCities(this.value)">
<!--                <option disabled selected>Select Country</option>-->
                <?php
                $query="SELECT DISTINCT country.id, country_name 
                        FROM country, hotel 
                        WHERE hotel.country_id = country.id 
                        ORDER BY country_name";
                $result = mysqli_query($connection,$query);
                while($row = mysqli_fetch_array($result))
                    echo '<option value="' . $row['id']. '">' . $row['country_name'] . '</option>';
                ?>
            </select>
        </div>
        <div class="col-lg-8 col-sm-6">
            Select city: <!-- city drop-down -->
            <select id="city" name="city">
<!--                <option disabled selected>Select City</option>-->
            </select>
        </div>
    </div>
    <!-- select arrival date and departure date -->
    <br>
    <div class="row">
        <div class="col-lg-4 col-sm-6">
            Arrival date:
            <input type="text" id="from_date" name="from_date" required
                   style="position: relative; z-index: 100000;"> <!-- style needed to show datepicker above other controls -->
        </div>
        <div class="col-lg-8 col-sm-6">
            Departure date:
            <input type="text" id="to_date" name="to_date" required
                   style="position: relative; z-index: 100000;"> <!-- style needed to show datepicker above other controls -->
        </div>
    </div>
    <!-- select hotel minimum stars -->
    <br>
    <div class="row">
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
            Minimum Hotel Stars:
        </div>
        <div class="col-xl-10 col-lg-9 col-md-8 col-sm-6">
            <select id="hotel_stars">
                <option value=""></option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3" selected>3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
    </div>
    <!-- select number of 1-bed rooms and price range for each such room -->
    <br>
    <div class="row">
        <div class="col-md-3 noselect"> <!-- for noselect class see https://stackoverflow.com/questions/826782/how-to-disable-text-selection-highlighting-using-css -->
            1-bed rooms:
            <nobr>
            <i class="fa fa-minus-square fa-2x" onclick="decrease('rooms_1b');"></i>
            <span id="rooms_1b" class="noselect">0</span>
            <i class="fa fa-plus-square fa-2x" onclick="increase('rooms_1b');"></i>
            </nobr>
        </div>
        <div class="col-md-2">
            Price range:
        </div>
        <div id="1b_range_slider" class="col-md-5"></div>
    </div>
    <!-- select number of 2-bed rooms and price range for each such room -->
    <br>
    <div class="row">
        <div class="col-md-3 noselect">
            2-bed rooms:
            <nobr>
            <i class="fa fa-minus-square fa-2x" onclick="decrease('rooms_2b');"></i>
            <span id="rooms_2b" class="noselect">0</span>
            <i class="fa fa-plus-square fa-2x" onclick="increase('rooms_2b');"></i>
            </nobr>
        </div>
        <div class="col-md-2">
            Price range:
        </div>
        <div id="2b_range_slider" class="col-md-5"></div>
    </div>
    <!-- select hotel minimum rating -->
    <br>
    <div class="row">
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
            Minimum Hotel Rating:
        </div>
        <div class="col-xl-10 col-lg-9 col-md-8 col-sm-6">
            <select id="hotel_rating">
                <option value=""></option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8" selected>8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
        </div>
    </div>
    <!-- select other hotel services -->
    <br>
    <div class="widget">
        <label for="breakfast">Breakfast</label>
        <input type="checkbox" name="breakfast" id="breakfast">
        <label for="dinner">Dinner</label>
        <input type="checkbox" name="dinner" id="dinner">
        <label for="parking">Parking</label>
        <input type="checkbox" name="parking" id="parking">
    </div>

    <br><br>
    <button type="submit" id="search_button" class="btn btn-primary" value="search">Search</button>

</form>

<div id="results_div">
    <!--  This div is populated by ajax_customer_search.php  -->
</div>


<!--
<div id="results" class="row" style="display: none">
    <form action="customer_confirmation.php">
        <hr><h4>Results</h4><hr>
        <div class="row">
            <div class="col-md-2"><p>Hotel Name</p></div>
            <div class="col-md-3"><a href="hotel_main.php" target="_blank"><img src="http://via.placeholder.com/150x100"></a></div>
            <div class="col-md-2"><p>Total price</p></div>
            <div class="col-md-2"><a href="hotel_main.php" target="_blank">Hotel Info</a></div>
            <div class="col-md-3"><input type="submit" class="btn btn-primary" value="Book it!"></div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-2"><p>Hotel Name</p></div>
            <div class="col-md-3"><a href="hotel_main.php" target="_blank"><img src="http://via.placeholder.com/150x100"></a></div>
            <div class="col-md-2"><p>Total price</p></div>
            <div class="col-md-2"><a href="hotel_main.php" target="_blank">Hotel Info</a></div>
            <div class="col-md-3"><input type="submit" class="btn btn-primary" value="Book it!"></div>
        </div>
    </form>
</div> <!-- end results row -->

<?php include "include/body_end_scripts.php" ?>
<?php include "include/customer_search_end_scripts.php" ?>

</div> <!-- end container -->
</body>
</html>