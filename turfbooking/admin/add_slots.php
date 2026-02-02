<?php include('partials/heaader.php'); ?>
<div class="main-content">
     <div class="wrapper">
     <h1>add Slots</h1>
     <br><br>
     <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];//message-failed to add slots
            unset($_SESSION['add']);//removing message
        }
         ?>
     <form action="" method="POST">
            <table class="addadminformtbl">
                <tr>
                    <td>Start time:</td>
                    <td>
                        <input type="text" id="s_time" name="s_time" placeholder="Enter Starting time"  required>
                    </td>
                </tr>
                <tr>
                    <td>End time:</td>
                    <td>
                    <input type="text" id="e_time" name="e_time" placeholder="Enter Ending time"  required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" id="submit" class="secondarybtn" name="submit" value="Add slot">
                    </td>

                </tr>
            </table>
        </form>
    </div>
</div>
<?php
//saves data to from the admin form to database
if(isset($_POST['submit']))
{
    $s_time=$_POST['s_time'];
    $e_time=$_POST['e_time'];
    $sql="INSERT INTO tbl_slot SET
    start_time='$s_time',
    end_time='$e_time'";
    $res=mysqli_query($conn,$sql) or die(mysqli_error());
    if($res===true){
        //echo"inserted successfully";
        //create a session variable to display message
        $_SESSION['add']='<div class="successmessage">Slot added successfully</div>';
        //Redirect manage-slot page
        header("location:".SITEURL.'admin/manage_slot.php');
    }
    else{
        //echo"insertion failed";
         //create a session variable to display message
         $_SESSION['add']='<div class="errormessage">Failed to add slot</div>';
         //Redirect add-slot page
         header("location:".SITEURL.'admin/add_slots.php');

    }
} 
?>
<?php include('partials/footer.php'); ?>