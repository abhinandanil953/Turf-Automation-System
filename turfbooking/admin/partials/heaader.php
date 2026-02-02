<?php
include("../admin/config/dbconnection.php");?>
<?php include('login_check.php'); 
 ?> 
<html>
<head>
  <title>Turf Booking Website</title>

  <link rel="stylesheet" href="../admin/css/admin.css">
</head>
<body>
   <!-- menu section starts-->
  <div class="menu text-center">
    <div class="wrapper">
       <ul>
       <li><a href="indexx.php?date=<?php echo strtotime(date("Y-m-d")); ?>">Home</a></li>
         <li><a href="manage_admin.php">manage admin</a></li>
         <li><a href="manage_feedback.php">feedback</a></li>
         <li><a href="manage_slot.php">slots</a></li>
         <li><a href="manage_booking.php">bookings</a></li>
         <li><a href="manage_payment.php">payments</a></li>
         <li><a href="logout.php">logout</a></li>
       </ul>
    </div>

  </div>
   <!-- menu section ends-->
</body>
</html>