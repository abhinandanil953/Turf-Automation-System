<?php
include("config/dbconnection.php");
 date_default_timezone_set('Asia/Kolkata');  

// Get the current date and time
$Time = date("H:i:s");

// SQL query to select expired time slots
$sql = "DELETE FROM tbl_slot WHERE end_time <='$Time'";
mysqli_query($conn, $sql);

// Close the database connection
mysqli_close($conn);
?>