<?php
session_start();
require_once "include/connect.php";
require_once "include/functions.php";
confirm_any_logged_in();

if ($_SESSION['user_type'] === 'owner') {
    // First, retrieve information from database and store it
    // in the arrays $hotel and $room2b
    $query = "SELECT * FROM hotel 
              WHERE Owner_ID = '{$_SESSION['user_id']}' 
              LIMIT 1";
    $result = mysqli_query($connection, $query) or die("Hotel ID SELECT failed");
    $hotel = mysqli_fetch_array($result);

    $query = "SELECT room.Info FROM room
          WHERE room.hotel_ID='{$hotel['ID']}' AND room.type_ID='2'
          LIMIT 1";
    $result = mysqli_query($connection, $query) or die("2-bed room Select Query failed");
    $room2b = mysqli_fetch_array($result);
}
require_once "include/head.php";
?>

<body>

<?php
include "include/hotel_navbar.php";
// Following query retrieves 2-bed room photos from db.
$query = "SELECT Img_type, Image FROM photo 
          WHERE Hotel_ID = '{$hotel['ID']}' AND Kind_ID = '4' ";
$result = mysqli_query($connection, $query) or die("Photos SELECT failed");
$rows = mysqli_num_rows($result); //$rows is the number of photos
?>

<div class="container">
    <div class="row">
        <div class="col-sm-10 col-md-8">
            <h2><?php echo $hotel['Name'];   ?></h2>
            <div id="demo" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <?php
                    for ($i=0; $i<$rows; $i++) {
                        echo "<li data-target='#demo' data-slide-to='" . $i . "'></li>";
                    }
                    ?>
                </ol>

                <!-- The slideshow -->
                <div class="carousel-inner">
                    <?php
                    for ($i=0; $i<$rows; $i++) {
                        if ($i===0) $active_string='active'; else $active_string='';
                        echo "<div class='carousel-item ". $active_string ."'>";
                        $row = mysqli_fetch_array($result);
                        echo "<img class='img-fluid' style='width: 100%;' 
                               src=\"data:image/"."{$row['Img_type']}".";base64, " . base64_encode($row['Image']) . " \"  alt='Hotel Photo' >";
                        echo "</div>";
                    }
                    ?>
                </div>

                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div> <!-- end carousel -->
        </div>
    </div> <!-- end row -->

    <div class="row">
        <div class="col-sm-10 col-md-8">
            <?php
            echo nl2br($room2b['Info']);
            ?>
        </div>
    </div>

</div> <!-- end container -->

<?php include "include/body_end_scripts.php" ?>
</body>

</html>