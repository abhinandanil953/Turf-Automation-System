<?php
include("config/dbconnection.php");

// Get the current date
$currentDate = date("Y-m-d");

// SQL query to delete bookings older than the current date
$sql = "DELETE FROM tbl_booking WHERE s_date < '$currentDate'";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Old bookings deleted successfully!";
} else {
    echo "Error deleting old bookings: " . mysqli_error($conn);
}

mysqli_close($conn);
?>