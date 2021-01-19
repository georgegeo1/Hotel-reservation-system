<?php
$connection = mysqli_connect('localhost', 'wd', 'wdihu') or die("Connection failed");
mysqli_set_charset($connection, 'utf8');
$dbselected = mysqli_select_db($connection, "wd_hotelsproject") or die("Database selection failed");