<?php
session_start();
include("dbconnection.php");

if (isset($_POST['slot_id'])) {
    $slotId = $_POST['slot_id'];

    // Query to retrieve the slot details
    $sql = "SELECT * FROM tbl_slot WHERE s_id = $slotId";
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        // Fetch the slot details
        $row = mysqli_fetch_assoc($res);

        // Insert the slot details into del_tbl_slot
        $insertSql = "INSERT INTO del_tbl_slot (slot_date, start_time, end_time, price) VALUES (
            '" . $row['slot_date'] . "',
            '" . $row['start_time'] . "',
            '" . $row['end_time'] . "',
            '" . $row['price'] . "'
        )";
        $insertResult = mysqli_query($conn, $insertSql);

        if ($insertResult) {
            // Delete the slot from tbl_slot
            $deleteSql = "DELETE FROM tbl_slot WHERE s_id = $slotId";
            $deleteResult = mysqli_query($conn, $deleteSql);

            if ($deleteResult) {
                // Slot deleted successfully
                header("Location: payment.php"); // Redirect to the payment page
                exit();
            } else {
                echo "Error deleting slot.";
            }
        } else {
            echo "Error inserting slot details into del_tbl_slot.";
        }
    } else {
        echo "Slot not found.";
    }
} else {
    echo "Slot ID is missing.";
}
?>