<?php
session_start();
//define constants
define('SITEURL','http://localhost/Turfbooking/');


//database connection
$conn=mysqli_connect('localhost','root','','turf_automation') or die(mysqli_error());

?>