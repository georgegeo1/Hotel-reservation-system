<?php

$country_id = $_GET['country_id'];
$city = $_GET['city'];
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];

$hotel_stars = $_GET['hotel_stars'];
if (empty($hotel_stars)) $hotel_stars=0;

$rooms_1b = $_GET['rooms_1b'];
$min_1b = $_GET['min_1b'];
$max_1b = $_GET['max_1b'];
$rooms_2b = $_GET['rooms_2b'];
$min_2b = $_GET['min_2b'];
$max_2b = $_GET['max_2b'];

$hotel_rating = $_GET['hotel_rating'];
if (empty($hotel_rating)) $hotel_rating=0;

$breakfast = $_GET['breakfast'];
$dinner = $_GET['dinner'];
$parking = $_GET['parking'];

echo $country_id . ' ' . $city . ' ' . $from_date . ' ' . $to_date
        . ' ' . $hotel_stars . ' '
        . $rooms_1b . ' ' . $min_1b . ' ' . $max_1b . ' '
        . $rooms_2b . ' ' . $min_2b . ' ' . $max_2b . ' '
        . $hotel_rating . ' ' . $breakfast . ' ' . $dinner . ' ' . $parking;

