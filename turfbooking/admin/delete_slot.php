<?php 
include("config/dbconnection.php");
//gets id from manage_slots.php through url
$id=$_GET["id"];
//Sql query to delete admin from database
$sql="DELETE FROM tbl_slot WHERE s_id='$id'";
$res=mysqli_query($conn,$sql) or die(mysqli_error());
if($res===true){
    //create a session variable to display message
    $_SESSION['delete']='<div class="successmessage">Slot deleted successfully</div>';
    //Redirect manage_slot page
    header("location:".SITEURL.'admin/manage_slot.php');
}
else{
     //create a session variable to display message
     $_SESSION['delete']='<div class="errormessage">Failed to delete slot</div>';
     header("location:".SITEURL.'admin/manage_slot.php');

}

?>