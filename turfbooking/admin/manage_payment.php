<?php include('partials/heaader.php'); ?>

   
   <!-- main-content section starts-->
  <div class="main-content">
     <div class="wrapper">
     <h1>All payments</h1>
     
     <Br><br>
     <?php
     ?>
       <Br><br>
       <Br><br>

     <table class='tbl-full'>
      <tr>
         <th>S.N</th>
         <th>slot_id</th>
         <th>full_name</th>
         <th>email</th>
         <th>payment method</th>
         <th>card number</th>
         <th>card cvv</th>
         <th>amount recieved</th>
      </tr>

      <?php
            //query to get and display the list of admins
            $sql="SELECT * FROM tbl_payment";
            $res=mysqli_query($conn,$sql);
            if($res==TRUE)
            {
                $count=mysqli_num_rows($res);//Gets the the number of admins 
                $sn=1;
                if($count>0){
                    //there is data in database
                    //fetching data row by row from database
                    while($rows=mysqli_fetch_assoc($res)){
                        $id=$rows['p_id'];
                        $full_name=$rows['full_name'];
                        $email=$rows['email'];
                        $s_id=$rows['s_id'];
                        $pay_m=$rows['payment_method'];
                        $card_no=$rows['card_number'];
                        $card_cvv=$rows['card_cvv'];
                        $amount=$rows['amount_paid'];
                        
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $s_id; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $pay_m; ?></td>
                            <td>**** **** **** <?php echo substr($card_no, -4); ?></td>
                            <td><?php echo $card_cvv; ?></td>
                            <td><?php echo $amount; ?></td>
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
