<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, td, th {
            border: 1px solid black;
            padding: 5px;
        }

        th {text-align: left;}
    </style>
</head>
<body>

<?php
$q = intval($_GET['q']);

$connection = mysqli_connect('localhost', 'wd', 'wdihu') or die("Connection failed");
$db = mysqli_select_db($connection, "wd_hotelsproject");

$sql = "SELECT * FROM reservation WHERE Customer_ID = '".$q."'";
$resultset = mysqli_query($connection, $sql) or die("database error:". mysqli_error($connection));


echo "<table>
<tr>
<th>Customer_ID</th>
<th>Room_ID</th>
<th>Arrival</th>
<th>Departure</th>
<th>Quantity</th>
<th>Request</th>
<th>Rating</th>
<th>Comments</th>
</tr>";
while($row = mysqli_fetch_array($resultset)) {
    echo "<tr>";
    echo "<td>" . $row['Customer_ID'] . "</td>";
    echo "<td>" . $row['Room_ID'] . "</td>";
    echo "<td>" . $row['Arrival'] . "</td>";
    echo "<td>" . $row['Departure'] . "</td>";
    echo "<td>" . $row['Quantity'] . "</td>";
    echo "<td>" . $row['Request'] . "</td>";
    echo "<td>" . $row['Rating'] . "</td>";
    echo "<td>" . $row['Comments'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($connection);
?>
</body>
</html>
