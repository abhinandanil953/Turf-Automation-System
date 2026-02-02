 <?php include("dbconnection.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'partials/head.php'; ?>
<!-- header.php -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../user/css/feedback.css">
    <title>Submit Feedback - Your Turf Booking System</title>
</head>
<body>
    <div class="container">
	<br><br>
        <h1>Submit Feedback</h1>

        <form action="" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><BR><BR>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><BR><BR>

            <label for="feedback">Feedback:</label>
            <textarea id="feedback" name="feedback" rows="4" cols="30" required></textarea><BR><BR>

            <button type="submit" name="submit">Submit Feedback</button>
        </form>
    </div>
	</body>
	<?php
	if(isset($_POST["submit"])){
		$name = $_POST["name"];
		$email = $_POST["email"];
		$feedback = $_POST["feedback"];
		
		$sql = "INSERT INTO tbl_feedback(f_name,f_email,f_feedback) VALUES('$name', '$email', '$feedback')";
		
	   if ($conn->query($sql) === TRUE) {
        echo "Feedback submitted successfully!";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
	}
	?>
		
<!--menu section ends here-->
<?php include 'partials/footer.php'; ?>
</html>