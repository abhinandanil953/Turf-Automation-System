<?php
session_start();

if (isset($_SESSION['booking_details'])) {
    // Retrieve booking details from the session
    $bookingDetails = $_SESSION['booking_details'];
    $slotId = $bookingDetails['slot_id'];
    $date = $bookingDetails['date'];
    $startTime = $bookingDetails['start_time'];
    $endTime = $bookingDetails['end_time'];
    $price = $bookingDetails['price'];

    // Perform the booking process (e.g., update the database)
    // ...

    // Clear the booking details from the session
    unset($_SESSION['booking_details']);

    // Redirect to a confirmation page or thank you page
    header("Location: confirmation_page.php");
    exit;
} else {
    // Handle the case when booking details are not found in the session
    echo "Booking details not found.";
}
?>