<?php include("partials/head.php"); ?>
 <?php include("dbconnection.php"); ?>
 <?php date_default_timezone_set('Asia/Kolkata');  ?>
<!-- book your show Section Starts Here -->
<link rel="stylesheet" href="../user/css/user.css">
    <section class="book-show">
        <div class="container">
            <h2 class="text-center">Book Your Slots</h2>
			<h3 class="text-center">List of Available slots </h3>
			<BR><br>
			 <table class="styled-table">
      <tr>
         <th>S.N</th>
         <th>date</th>
         <th>start time</th>
		 <th>end time</th>
		 <th>price</th>
		 <th>book slot</th>
      </tr>
            <?php 
            //query to get and display the list of movies
            $bookedslot=0;
            
            $sql1="SELECT * FROM tbl_slot";
            $res1=mysqli_query($conn,$sql1);
            if($res1==TRUE)
            {
                $count1=mysqli_num_rows($res1);//Gets the the number of movies
                $sn=1;
                if($count1>0){
                    //there is data in database
                    //fetching data row by row from database
                    while($rows1=mysqli_fetch_assoc($res1)){
                        $id=$rows1['s_id'];
                        $date=$rows1['slot_date'];
                        $s_time=$rows1['start_time'];
						$e_time=$rows1['end_time'];
                        $price=$rows1['price'];

                        $current_time = date("H:i:s");
                        $isSlotExpired = $s_time <= $current_time;
                        ?>
                <div class="book-show-desc">
						<tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $date; ?></td>
							<td><?php echo $s_time; ?></td>
							<td><?php echo $e_time; ?></td>
							<td><?php echo $price; ?></td>
                            <td>
                                <?php if (!$isSlotExpired) { ?>
                                <a href="<?php echo SITEURL; ?>user/confirm_booking.php?id=<?php echo $id; ?>"
                                class="secondarybtn">BOOK NOW</a>
                                <?php } else { ?>
                                <button onclick="showExpiredAlert()" class="slotexpbtn" >SLOT EXPIRED</button>
                                <?php } ?>
                            </td>
                         </tr>
                </div>
        </div>
		<?php
					}
				}
			}
		?>	
	    </table>
        <script>
    function showExpiredAlert() {
        alert('The slot is expired');
    }
</script>

        <div class="clearfix"></div>
</section>
 <?php include 'partials/footer.php'; ?>