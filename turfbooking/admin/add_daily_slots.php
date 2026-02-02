<?php
include("config/dbconnection.php");

// Define the start and end times
$startTime = "13:00:00";
$endTime = "18:00:00"; // 6 slots with 1-hour duration

// Calculate the interval between slots (1 hour)
$interval = new DateInterval('PT1H');

// Get the current date
$currentDate = date("Y-m-d");

// Create a DateTime object for the start time
$startDateTime = new DateTime("$currentDate $startTime");

// Create a DateTime object for the end time
$endDateTime = new DateTime("$currentDate $endTime");

// Loop to add 6 time slots
for ($i = 1; $i <= 6; $i++) {
    // Get the slot start time and end time
    $slotStartTime = $startDateTime->format("Y-m-d H:i:s");
    $startDateTime->add($interval);
    $slotEndTime = $startDateTime->format("Y-m-d H:i:s");

    // Insert the slot into the database
    $sql = "INSERT INTO tbl_slot (slot_date, start_time, end_time) VALUES ('$currentDate', '$slotStartTime', '$slotEndTime')";
    mysqli_query($conn, $sql);
}

// Close the database connection
mysqli_close($conn);
?>