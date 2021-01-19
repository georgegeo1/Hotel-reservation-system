<?php
require_once '../include/connect.php';

$country_id = intval($_GET['country_id']);


$query="SELECT city FROM hotel WHERE country_id = '" . $country_id . "' ORDER BY city";
$result = mysqli_query($connection,$query);

//echo "<option disabled selected></option>";
//$row = mysqli_fetch_array($result);
//echo "<option selected>" . $row['city'] . "</option>";
while($row = mysqli_fetch_array($result)) {
    echo "<option>" . $row['city'] . "</option>";
}

mysqli_close($connection);


