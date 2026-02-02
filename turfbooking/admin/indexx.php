<html lang="en">
<head>
<title>Login Turf Booking system</title>
</head>
<?php include('partials/heaader.php') ?>
   <!-- main-content section starts-->
  <div class="main-content">
     <div class="wrapper">
      <h1>DASHBOARD</h1>
<?php

 if(isset($_SESSION['login'])){
  echo $_SESSION['login'];//message login successfully
  unset($_SESSION['login']);//removing message on refresh
}

if($_SESSION["user"]) {
  ?>
  <h1>Welcome <?php echo $_SESSION["user"]; ?> </h1>;
  <?php
  }
?>

      <div class="col-4">
        <h1>5</h1>
        <br>
        Category
      </div>

      <div class="col-4">
        <h1>5</h1>
        <br>
        Category
      </div>

      <div class="col-4">
        <h1>5</h1>
        <br>
        Category
      </div>

      <div class="col-4">
        <h1>5</h1>
        <br>
        Category
      </div>
      
      <div class="clearfix"> </div>

    </div>


  </div>
   <!-- main-content section ends-->
   
   <?php include('partials/footer.php') ?>
  </html>