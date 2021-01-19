<?php
session_start();
require_once "include/connect.php";
require_once "include/functions.php";
confirm_owner_logged_in();

$user_id = $_SESSION['user_id'];
require_once "include/head.php";
?>

<body>

<?php
include "include/owner_navbar.php";

// First, retrieve information from database and store it
// in the arrays $hotel, $room1b and $room2b
$query = "SELECT * FROM hotel WHERE Owner_ID ='{$user_id}' LIMIT 1";
$result = mysqli_query($connection, $query) or die("Hotel Select Query failed");
$hotel = mysqli_fetch_array($result);

$query = "SELECT room.Info FROM room
          WHERE room.hotel_ID='{$hotel['ID']}' AND room.type_ID='1'
          LIMIT 1";
$result = mysqli_query($connection, $query) or die("1-bed room Select Query failed");
$room1b = mysqli_fetch_array($result);

$query = "SELECT room.Info FROM room
          WHERE room.hotel_ID='{$hotel['ID']}' AND room.type_ID='2'
          LIMIT 1";
$result = mysqli_query($connection, $query) or die("2-bed room Select Query failed");
$room2b = mysqli_fetch_array($result);

//Following three lines executed when page entered for first time
$hide1 = '';
$hide2 = 'hidden';
$hide3 = 'hidden';

// Following section executed after submission of 'first page'.
if (isset($_POST['save_btn']) && $_POST['save_btn']=='page1') {
    $query = "UPDATE hotel SET 
                Name = '{$_POST['hotel_name']}' ,
                Stars = '{$_POST['hotel_stars']}' ,
                Country_ID = '{$_POST['hotel_country_id']}',
                City = '{$_POST['hotel_city']}',
                Address = '{$_POST['hotel_address']}',
                Tel = '{$_POST['hotel_tel']}',
                Email = '{$_POST['hotel_email']}',
                Latitude = '{$_POST['hotel_lat']}',
                Longitude = '{$_POST['hotel_lng']}'
              WHERE Owner_ID = '{$user_id}'
              ";
    $result = mysqli_query($connection, $query) or die("Update page1 Query failed");

    $hide1 = 'hidden';
    $hide2 = '';
    $hide3 = 'hidden';
}

// Following section executed after submissio of 'second page'.
if (isset($_POST['save_btn']) && $_POST['save_btn']=='page2') {
    $query = "UPDATE hotel SET 
                Info = '{$_POST['info_main']}' 
              WHERE Owner_ID = '{$user_id}'
              ";
    $result = mysqli_query($connection, $query) or die("Update hotel main info Query failed");

    $query = "UPDATE room SET 
                Info = '{$_POST['info_1b']}' 
              WHERE room.hotel_ID='{$hotel['ID']}' AND room.type_ID='1'
              ";
    $result = mysqli_query($connection, $query) or die("Update 1b room Query failed");

    $query = "UPDATE room SET 
                Info = '{$_POST['info_2b']}' 
              WHERE room.hotel_ID='{$hotel['ID']}' AND room.type_ID='2'
              ";
    $result = mysqli_query($connection, $query) or die("Update 2b room Query failed");

    $hide1 = 'hidden';
    $hide2 = 'hidden';
    $hide3 = '';
}
?>

<div class="container">
<form action="#" method="post">
    <br>
    <!-- Following div shown when 'first page' loads -->
    <div <?php echo $hide1; ?>>
        <!-- Hotel name -->
        <div class="form-group row">
            <label for="hotel_name" class="col-sm-2 col-form-label">Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="hotel_name" required
                       value="<?php echo $hotel['Name']; ?>" >
            </div>
        </div>
        <!-- Hotel stars -->
        <div class="form-group row">
            <label for="hotel_stars" class="col-sm-2 col-form-label">Stars:</label>
            <div class="col-sm-2">
                <input type="number" class="form-control" name="hotel_stars" min="1" max="5"
                       value="<?php echo $hotel['Stars']; ?>" >
            </div>
        </div>
        <!-- Hotel country -->
        <div class="form-group row">
            <label for="hotel_country_id" class="col-sm-2 col-form-label">Country:</label>
            <div class="col-sm-10">
                <select name="hotel_country_id">
                    <?php
                    $query = "SELECT * FROM country ORDER BY country_name";
                    $result = mysqli_query($connection, $query) or die("Countries Select Query failed");
                    while($row = mysqli_fetch_array($result)) {
                        if ($row['id'] == $hotel['Country_ID']) $selected = 'selected'; else $selected = '';
                        echo '<option value="' . $row['id'] . '" ' .$selected.'>' . $row['country_name'] . '</option>';
                        }
                    ?>
                </select>
            </div>
        </div>
        <!-- Hotel city -->
        <div class="form-group row">
            <label for="hotel_city" class="col-sm-2 col-form-label">City:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="hotel_city" name="hotel_city"
                       value="<?php echo $hotel['City']; ?>" >
            </div>
        </div>
        <!-- Hotel address -->
        <div class="form-group row">
            <label for="hotel_address" class="col-sm-2 col-form-label">Address:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="hotel_address" name="hotel_address"
                       value="<?php echo $hotel['Address']; ?>" >
            </div>
        </div>
        <!-- Hotel telephone -->
        <div class="form-group row">
            <label for="hotel_tel" class="col-sm-2 col-form-label">Telephone:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="hotel_tel" name="hotel_tel"
                       value="<?php echo $hotel['Tel']; ?>" >
            </div>
        </div>
        <!-- Hotel email -->
        <div class="form-group row">
            <label for="hotel_email" class="col-sm-2 col-form-label">E-mail:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="hotel_email" name="hotel_email"
                       value="<?php echo $hotel['Email']; ?>" >
            </div>
        </div>

        <br>
        <input type="text" hidden id="hotel_lat" name="hotel_lat"
               value="<?php echo $hotel['Latitude']; ?>">
        <input type="text" hidden id="hotel_lng" name="hotel_lng"
               value="<?php echo $hotel['Longitude']; ?>">

        <div class="form-group row">
            <div class="col-sm-10" id="map" style="width:400px;height:400px"></div>
        </div>
        <br>
        <button class="btn btn-primary" type='submit'
                name="save_btn" value="page1">Save and Continue</button>

    </div>

    <!-- Following div shown when 'second page' loads -->

    <div <?php echo $hide2; ?>>
    <div class="form-group row">
        <label for="info_main" class="col-form-label">Hotel Main Information :</label>
        <textarea class="form-control" id="info_main" rows="15" name="info_main"><?php echo $hotel['Info']; ?></textarea>
        <br>
    </div>
    <div class="form-group row">
        <label for="info_1b" class="col-form-label">1-bed Room Information :</label>
        <textarea class="form-control" id="info_1b" rows="15" name="info_1b"><?php echo $room1b['Info']; ?></textarea>
        <br>
    </div>
    <div class="form-group row">
        <label for="info_2b" class="col-form-label">2-bed Room Information :</label>
        <textarea class="form-control" id="info_2b" rows="15" name="info_2b"><?php echo $room2b['Info']; ?></textarea>
        <br>
    </div>
        <button class="btn btn-primary" type='submit'
                name="save_btn" value="page2">Save and Continue</button>
        <br>
    </div>

    <script src="include/owner_edit_end.js"></script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key= AIzaSyCIFAWX2Ma5BNh_91eEx1BjvtVC9AoZi4Y&callback=myMap&language=en">
    </script>


</form>

</div> <!-- end container -->

</body>
</html>