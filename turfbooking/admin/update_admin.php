
<?php include('partials/heaader.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>
        <?php 
        $id=$_GET['id'];
        $sql="SELECT * FROM tbl_admin WHERE ad_id='$id'";
        $res=mysqli_query($conn,$sql);
        if($res==TRUE){
            $count=mysqli_num_rows($res);
            if($count==1){
                while($rows=mysqli_fetch_assoc($res)){
                  $username=$rows['username'];
                }
            }
            else{
                header("location".SITEURL."admin/manage_admin.php");
            }
        }
        ?>
        <form action="" method="POST">
        <table class="addadminformtbl">
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" id="username" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" id="submit" class="addadminbtn" name="submit" value="Update Admin">
                    </td>

                </tr>
            </table>
        </form>
    </div>
</div>
<?php 
//updates admin details
$id=$_GET['id'];
if(isset($_POST['submit'])){
    $username=$_POST['username'];  
    $sql1="UPDATE tbl_admin SET 
    username='$username'
    WHERE ad_id='$id'"; 
    $res1=mysqli_query($conn,$sql1);
    if($res1==true){
        //create a session variable to display message
        $_SESSION['update']='<div class="successmessage">Admin updated successfully</div>';
        //Redirect manage-admin page
        header("location:".SITEURL.'admin/manage_admin.php');
    }
    else{
         //create a session variable to display message
         $_SESSION['update']='<div class="errormessage">Failed to update admin</div>';
         //Redirect add-admin page
         header("location:".SITEURL.'admin/update_admin.php');

    }

}
    ?>
<?php include('partials/footer.php');?>