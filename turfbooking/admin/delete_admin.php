<?php 
include("config/dbconnection.php");

$id = $_GET["id"];

$sqlCountAdmins = "SELECT COUNT(*) FROM tbl_admin";
$countAdminsResult = mysqli_query($conn, $sqlCountAdmins);

if ($countAdminsResult) {
    $adminCount = mysqli_fetch_row($countAdminsResult)[0];

    if ($adminCount <= 1) {
        $_SESSION['delete'] = '<div class="errormessage">Cannot delete the last admin</div>';
        header("location:".SITEURL.'admin/manage_admin.php');
        exit;
    }

    $sql = "DELETE FROM tbl_admin WHERE ad_id='$id'";
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    if ($res === true) {
        
        $_SESSION['delete'] = '<div class="successmessage">Admin deleted successfully</div>';
    } else {
       
        $_SESSION['delete'] = '<div class="errormessage">Failed to delete admin</div>';
    }
} else {
    $_SESSION['delete'] = '<div class="errormessage">Failed to get admin count</div>';
}

header("location:".SITEURL.'admin/manage_admin.php');
?>