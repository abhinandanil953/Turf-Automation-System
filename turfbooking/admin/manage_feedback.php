
<?php include('partials/heaader.php'); ?>

   
   <!-- main-content section starts-->
  <div class="main-content">
     <div class="wrapper">
     <h1>Manage feedback</h1>

    
    <br>
    <table  align="center" class='tbl-full'>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Feedback</th>
			<th>Date,Time</th>
        </tr>
        <?php
        $sql = "SELECT * FROM tbl_feedback";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['f_name'] . "</td>";
                echo "<td>" . $row['f_email'] . "</td>";
                echo "<td>" . $row['f_feedback'] . "</td>";
				echo "<td>" . $row['submission_date'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No feedback available.</td></tr>";
        }

        // Close connection
        mysqli_close($conn);
        ?>
    </table>

    </div>
  </div>
   <!-- main-content section ends-->
      
<?php include('partials/footer.php'); ?>
