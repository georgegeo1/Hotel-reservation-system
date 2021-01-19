
<?php
//filter.php

if(isset($_POST["from_date"], $_POST["to_date"]))
{
    $connection = mysqli_connect('localhost', 'wd', 'wdihu') or die("Connection failed");
    $db = mysqli_select_db($connection, "wd_hotelsproject");
    $output = '';
    $query = "SELECT * FROM reservation WHERE Departure BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'";
    $result = mysqli_query($connection, $query);
    $output .= '  
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
      ';
    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            $output .= '  
                     <tr>  
                          <td>'. $row["Customer_ID"] .'</td>  
                          <td>'. $row["Room_ID"] .'</td>  
                          <td>'. $row["Arrival"] .'</td>  
                          <td> '. $row["Departure"] .'</td>  
                          <td>'. $row["Quantity"] .'</td>  
                          <td>'. $row["Request"] .'</td>  
                          <td>'. $row["Rating"] .'</td>  
                          <td> '. $row["Comments"] .'</td>  

                     </tr>  
                ';
        }
    }
    else
    {
        $output .= '  
                <tr>  
                     <td colspan="10">No departures relevant to the reservations found during that period</td>  
                </tr>  
           ';
    }
    $output .= '</table>';
    echo $output;
}
?>


