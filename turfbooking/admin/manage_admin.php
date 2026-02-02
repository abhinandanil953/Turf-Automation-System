
<?php include('partials/heaader.php'); ?>

   
   <!-- main-content section starts-->
  <div class="main-content">
     <div class="wrapper">
     <h1>Manage Admin</h1>
     
     <Br><br>
     <?php
       if(isset($_SESSION['add'])){
          echo $_SESSION['add'];
          unset($_SESSION['add']);
       }
       if(isset($_SESSION['delete'])){
         echo $_SESSION['delete'];//message-admin deleted successfully
         unset($_SESSION['delete']);//removing message on refresh
     }
     if(isset($_SESSION['update'])){
      echo $_SESSION['update'];//message-admin update successfully
      unset($_SESSION['update']);//removing message on refresh
  }
     ?>
       <Br><br>
       <Br><br>
     <a href="admin_add.php" class="primarybtn">Add Admin</a><br><br><br><br>

     <table class='tbl-full'>
      <tr>
         <th>S.N</th>
         <th>username</th>
         <th>Actions</th>
      </tr>

      <?php
            //query to get and display the list of admins
            $sql="SELECT * FROM tbl_admin";
            $res=mysqli_query($conn,$sql);
            if($res==TRUE)
            {
                $count=mysqli_num_rows($res);//Gets the the number of admins 
                $sn=1;
                if($count>0){
                    //there is data in database
                    //fetching data row by row from database
                    while($rows=mysqli_fetch_assoc($res)){
                        $id=$rows['ad_id'];
                        $username=$rows['username'];
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="<?php echo SITEURL;?>admin/update_admin.php?id=<?php echo $id; ?>"class="secondarybtn">Update Admin</a>
                                <!--passes id to delete-admin.php through get-->
                                <a href="<?php echo SITEURL;?>admin/delete_admin.php?id=<?php echo $id; ?>"class="temprarybtn">Delete Admin</a>
                            </td>
                         </tr>
                         <?php

                    }
                }
                else{
                    //no data in the database
                 }
            }
            ?>
     </table>

    </div>


  </div>
   <!-- main-content section ends-->
      
<?php include('partials/footer.php'); ?>
