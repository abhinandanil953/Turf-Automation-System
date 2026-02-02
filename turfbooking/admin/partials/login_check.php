<?php
//check wheather the user is login or not
if(!isset($_SESSION['user'])){
    $_SESSION['no-login-message']="<div class='errormessage text-center'>Please login to access Admin Panel.</div>";
    header("location:".SITEURL."admin/login.php");
}
?>