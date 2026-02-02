<html>
<head>
    <style>
         button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Hide the invoice download link by default */
        .invoice-link {
            display: none;
        }
        </style>
<?php
include("dbconnection.php"); // Include your database connection file here

// Function to get slot details by slot_id
function getSlotDetails($conn, $slotId) {
    $sql = "SELECT * FROM tbl_slot WHERE s_id = $slotId";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="stylesheet" type="text/css" href="./css/receipt.css">
</head>
<body>
    <h1>Thank You for Your Payment</h1>
    
    <?php
    // Check if the booking_details are set in the session
    if (isset($_SESSION['booking_details'])) {
        $bookingDetails = $_SESSION['booking_details'];
        $slotId = $bookingDetails['slot_id'];
        
        // Get slot details based on slot_id
        $slotDetails = getSlotDetails($conn, $slotId);
        
        if ($slotDetails) {
            // Generate the receipt content
            $receiptContent = "Payment Receipt\n";
            $receiptContent .= "<div class='receipt-item'><strong>Slot ID:</strong> " . $bookingDetails['slot_id'] . "</div>";
            $receiptContent .= "<div class='receipt-item'><strong>Full Name:</strong> " . $bookingDetails['full_name'] . "</div>";
            $receiptContent .= "<div class='receipt-item'><strong>Email:</strong> " . $bookingDetails['email'] . "</div>";
            $receiptContent .= "<div class='receipt-item'><strong>Date of Birth:</strong> " . $bookingDetails['dob'] . "</div>";
            $receiptContent .= "<div class='receipt-item'><strong>Gender:</strong> " . $bookingDetails['gender'] . "</div>";
            $receiptContent .= "<div class='receipt-item'><strong>Payment Method:</strong> " . $bookingDetails['payment_method'] . "</div>";
            $receiptContent .= "<div class='receipt-item'><strong>Card Number:</strong> **** **** **** " . substr($bookingDetails['card_number'], -4) . "</div>";
            $receiptContent .= "<div class='receipt-item'><strong>Expiry Date:</strong> " . $bookingDetails['expiry_month'] . '/' . $bookingDetails['expiry_year'] . "</div>";
            $receiptContent .= "<div class='receipt-item'><strong>Amount Paid:</strong> $" . $bookingDetails['price'] . "</div>";
            
            // Add slot details to the receipt
            $receiptContent .= "<div class='receipt-item'><strong>Date:</strong> " . $slotDetails['slot_date'] . "</div>";
            $receiptContent .= "<div class='receipt-item'><strong>Start Time:</strong> " . $slotDetails['start_time'] . "</div>";
            $receiptContent .= "<div class='receipt-item'><strong>End Time:</strong> " . $slotDetails['end_time'] . "</div>";
            
            // Output the receipt content
            echo "<div class='container'>";
            echo "<div class='receipt-container'>";
            echo "<p><strong>Receipt:</strong></p>";
            echo "<div class='receipt-content'>$receiptContent</div>";
            echo "</div>";
            
            // Provide a download link for the receipt
            echo "<p class='invoice-link'><button onclick='window.print()'>Download Invoice</button></p>";
            echo '<script>document.querySelector(".invoice-link").style.display = "block";</script>';
            
            // Delete the slot from tbl_slot
            $deleteSql = "DELETE FROM tbl_slot WHERE s_id = $slotId";
            if (mysqli_query($conn, $deleteSql)) {
                // Insert the deleted data into book_tbl_slot
                $insertSql = "INSERT INTO book_tbl_slot (s_id, slot_date, start_time, end_time, price) VALUES ('$slotId', '{$slotDetails['slot_date']}', '{$slotDetails['start_time']}', '{$slotDetails['end_time']}', '{$slotDetails['price']}')";
                mysqli_query($conn, $insertSql);
            } else {
                echo "<p>Error deleting slot details.</p>";
            }
        } else {
            echo "Slot details not found.";
        }
    } else {
        echo "Payment details not found.";
    }
    ?>
    
    <p class="back-to-home"><a href="home1.php">Back to Home</a></p>
</body>
</html>
