
<?php include("partials/heaader.php"); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];//message-failed to add admin
            unset($_SESSION['add']);//removing message
        }
         ?>
         <br><br>
        <form action="" method="POST">
            <table class="addadminformtbl">
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" id="username" name="username" placeholder="Enter Username" pattern="[A-Za-z0-9]{1,8}" title="Only letter and digits (Maximum 8)" required>
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                    <input type="password" id="password" name="password" placeholder="Enter password"pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{1,8}$" title="atleast one digit,character and special character  (Maximum 8)" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" id="submit" class="secondarybtn" name="submit" value="Add Admin">
                    </td>

                </tr>
            </table>
        </form>
    </div>
</div>
<?php include("partials/footer.php"); ?>
<?php
//saves data to from the admin form to database
if(isset($_POST['submit']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    $sql="INSERT INTO tbl_admin SET
    username='$username',
    pass='$password'";
    $res=mysqli_query($conn,$sql) or die(mysqli_error());
    if($res===true){
        //echo"inserted successfully";
        //create a session variable to display message
        $_SESSION['add']='<div class="successmessage">Admin added successfully</div>';
        //Redirect manage-admin page
        header("location:".SITEURL.'admin/manage_admin.php');
    }
    else{
        //echo"insertion failed";
         //create a session variable to display message
         $_SESSION['add']='<div class="errormessage">Failed to add admin</div>';
         //Redirect add-admin page
         header("location:".SITEURL.'admin/admin_add.php');

    }
} 
?>
