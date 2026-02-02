<?php include("config/dbconnection.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Turf Booking system</title>
    <link rel="stylesheet" href="../admin/css/adm2.css">
</head>
<body class="body">
   <div class="login">
  <img src="../admin/css/logo.png" width="40%" height="5%">
    <h1>Login</h1><br><br>
    <?php 
    if(isset($_SESSION['login'])){
        echo $_SESSION['login'];//message login successfully
        unset($_SESSION['login']);//removing message on refresh
    }
    if(isset($_SESSION['no-login-message'])){
        echo $_SESSION['no-login-message'];//message logincheck 
        unset($_SESSION['no-login-message']);//removing message on refresh
    }
    ?>
    <form action="" method="POST">
        Username:<br>
        <input type="text" id="username" name="username" placeholder="Enter Username"  required><br>
		<div class="password-container">
        Password:<br>
        <input type="password" id="password" name="password" placeholder="Enter Password"  pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{1,8}$" title="atleast one digit,character and special character  (Maximum 8)" required><br>
		<input type="checkbox" onclick="myFunction()">Show Password
		<br><br>
        <input type="submit" name="submit" value="Login" class="loginbutton"><br><br>
    </form>
<script>
function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

</script>
	
    <p>Created By <a href="www.abhinand@anil.com">Abhinand Anil</a></p>
   </div>
</body>
</html>
<!-- login functionalities -->
<!-- login validation -->
<?php 
if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $password=$_POST['password']; 
    $sql="SELECT * FROM tbl_admin WHERE username='$username' AND pass='$password'";
    $res=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($res);
    if(($count)==1)
    {
        $_SESSION['login']='<div class="successmessage">Login successfull</div>';
        header("location:".SITEURL."admin/indexx.php?date=".strtotime(date('Y-m-d')));
        $_SESSION['user']=$username;// to check wheather the user is logged in or not and logout will unset it
    }
    else
    {
        echo '<script>alert("Incorrect Username or Password. Please try again.");</script>';
         $_SESSION['login']='<div class="errormessage">Login Failed--Invalid Username and Password</div>';
         header("location".SITEURL."admin/login.php");
    }
} ?>