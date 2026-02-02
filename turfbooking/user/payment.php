<?php
include("dbconnection.php");
date_default_timezone_set('Asia/Kolkata');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <link href="./css/payment.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style_payment.css">
</head>

<body>
    <div class="wrapper">
        <h1><u>Book your Slot</u></h1>
        <h2>Payment Form</h2>
        <form method="POST" action="">
            <h4>Account</h4>
            <div class="input-group">
                <div class="input-box">
                    <input type="text" name="full_name" placeholder="Full Name" required class="name">
                    <i class="fa fa-user icon"></i>
                </div>
            </div>
            <br>
            <div class="input-group">
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email Adress" required class="name">
                    <i class="fa fa-envelope icon"></i>
                </div>
            </div>
            <br>
            <div class="input-group">
                <div class="input-box">
                    <h4> Date of Birth</h4>
                    <input type="text"  name="dob_dd" placeholder="DD" class="dob">
                    <input type="text"  name="dob_mm" placeholder="MM" class="dob">
                    <input type="text"  name="dob_yyyy" placeholder="YYYY" class="dob">
                </div>
                <br>
                <div class="input-box">
                    <h4> Gender</h4>
                    <input type="radio" id="b1" name="gender" checked class="radio">
                    <label for="b1">Male</label>
                    <input type="radio" id="b2" name="gender" class="radio">
                    <label for="b2">Female</label>
                </div>
            </div>
            <br>
            <div class="input-group">
                <div class="input-box">
                    <h4>Payment Details</h4>
                    <input type="radio" name="payment_method" id="bc1" checked class="radio">
                    <label for="bc1"><span><i class="fa fa-cc-visa"></i> Credit Card</span></label>
                    <input type="radio" name="payment_method" id="bc2" class="radio">
                    <label for="bc2"><span><i class="fa fa-cc-paypal"></i> Paypal</span></label>
                </div>
            </div>
            <div class="input-group">
                <div class="input-box">
                    <input type="tel" name="card_number" placeholder="Card Number" required class="name">
                    <i class="fa fa-credit-card icon"></i>
                </div>
                <br>
            </div>
            <div class="input-group">
                <div class="input-box">
                    <input type="tel" name="card_cvv" placeholder="Card CVV" required class="name">
                    <i class="fa fa-user icon"></i>
                </div>
                <br>
                <div class="input-box">
                    <select name="expiry_month">
                        <option>jan</option>
                        <option>feb</option>
                        <option>mar</option>
                        <option>apr</option>
                        <option>may</option>
                        <option>jun</option>
                        <option>jul</option>
                        <option>aug</option>
                        <option>sep</option>
                        <option>oct</option>
                        <option>nov</option>
                        <option>dec</option>                       
                    </select>
                    <select name="expiry_year">
                        <option>2024</option>
                        <option>2025</option>
                        <option>2026</option>
                        <option>2027</option>
                        <option>2028</option>
                        <option>2029</option>
                    </select>
                </div>
            </div>
            <br><br>
            <div class="input-group">
                <div class="input-box">
                    <button type="submit" name="submit">PAY NOW</button>
                </div>
            </div>
        </form>
    </div>
    <?php
    if(isset($_POST['submit'])){
        // Get the payment data from the form
        $fullName = $_POST['full_name'];
        $email = $_POST['email'];
        $dob = $_POST['dob_dd'] . '-' . $_POST['dob_mm'] . '-' . $_POST['dob_yyyy'];
        $gender = $_POST['gender'];
        $paymentMethod = $_POST['payment_method'];
        $cardNumber = $_POST['card_number'];
        $cardCVV = $_POST['card_cvv'];
        $expiryMonth = $_POST['expiry_month'];
        $expiryYear = $_POST['expiry_year'];
    
        // Retrieve booking details from the session
        $bookingDetails = $_SESSION['booking_details'];
        $slotId = $bookingDetails['slot_id'];
        $date = $bookingDetails['date'];
        $startTime = $bookingDetails['start_time'];
        $endTime = $bookingDetails['end_time'];
        $price = $bookingDetails['price'];
    
        $sql = "INSERT INTO tbl_payment (s_id, full_name, email, dob, payment_method, card_number, card_cvv, expiry_month, expiry_year, amount_paid) VALUES ('$slotId', '$fullName', '$email', '$dob', '$paymentMethod', '$cardNumber', '$cardCVV', '$expiryMonth', '$expiryYear', '$price')";
        $sql1= "INSERT INTO tbl_booking (full_name,email,s_id,s_date,start_time,end_time,price) values('$fullName', '$email','$slotId','$date','$startTime','$endTime','$price')";
        $res3=mysqli_query($conn, $sql1);

        if (mysqli_query($conn, $sql)) {
            // Payment successful, generate a receipt
            $receipt = "Payment Receipt\n";
            $receipt .= "Slot ID: $slotId\n";
            $receipt .= "Slot date: $date\n";
            $receipt .= "Start_time: $startTime\n";
            $receipt .= "End time: $endTime\n";
            $receipt .= "Full Name: $fullName\n";
            $receipt .= "Email: $email\n";
            $receipt .= "Date of Birth: $dob\n";
            $receipt .= "Gender: $gender\n";
            $receipt .= "Payment Method: $paymentMethod\n";
            $receipt .= "Card Number: **** **** **** " . substr($cardNumber, -4) . "\n";
            $receipt .= "Expiry Date: $expiryMonth/$expiryYear\n";
            $receipt .= "Amount Paid: $price\n";

            $_SESSION['booking_details'] = [
                'slot_id' => $slotId,
                'full_name' => $fullName,
                'email' => $email,
                'dob' => $dob,
                'gender' => $gender,
                'payment_method' => $paymentMethod,
                'card_number' => $cardNumber,
                'expiry_month' => $expiryMonth,
                'expiry_year' => $expiryYear,
                'price' => $price
                // Add other relevant data as needed
            ];
    
            header("Location: receipt.php");

            
            exit();
        } else {
            // Handle the case where the payment data could not be inserted into the database
            echo "Payment failed. Please try again later.";
        }
    }
    ?>
</body>

</html>
