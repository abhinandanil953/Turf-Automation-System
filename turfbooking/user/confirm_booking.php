<?php
include("partials/head.php");
include("dbconnection.php");
date_default_timezone_set('Asia/Kolkata');
?>
<link rel="stylesheet" href="../user/css/user.css">

<?php
// Check if the slot ID is passed in the URL
if (isset($_GET['id'])) {
    $slotId = $_GET['id'];

    // Query to retrieve the slot details
    $sql = "SELECT * FROM tbl_slot WHERE s_id = $slotId";
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        // Fetch the slot details
        $row = mysqli_fetch_assoc($res);
        $date = $row['slot_date'];
        $s_time = $row['start_time'];
        $e_time = $row['end_time'];
        $price = $row['price'];

        // Store slot details in a session for later use
        $_SESSION['booking_details'] = [
            'slot_id' => $slotId,
            'date' => $date,
            'start_time' => $s_time,
            'end_time' => $e_time,
            'price' => $price
        ];
        ?>

        <!-- HTML content for the confirmation page -->
        <div class="container">
            <h2 class="text-center">Confirm Your Booking</h2>
            <div class="confirmation-details">
                <br><br>
                <p><strong>Date:</strong> <?php echo $date; ?></p>
                <br><br>
                <p><strong>Start Time:</strong> <?php echo $s_time; ?></p>
                <br><br>
                <p><strong>End Time:</strong> <?php echo $e_time; ?></p>
                <br><br>
                <p><strong>Price:</strong> <?php echo $price; ?></p>
                <br><br>
                <!-- Add more details as needed -->
                <br><br>
                <!-- Add a form for confirming the booking -->
                <form action="" method="POST">
                    <!-- Add more hidden fields as needed -->
                    <button type="submit" class="secondarybtn" ><a href="payment.php">pay now</a></button>
                </form>
            </div>
        </div>
        <?php
    } else {
        // Handle the case when the slot ID doesn't exist in the database
        echo "Slot not found.";
    }
} else {
    // Handle the case when the slot ID is not provided in the URL
    echo "Slot ID is missing.";
}
?>

<!-- Include your footer or other necessary content -->
<?php include 'partials/footer.php'; ?>