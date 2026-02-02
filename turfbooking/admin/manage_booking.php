<?php include('partials/heaader.php'); ?>
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<!-- main-content section starts-->
<div class="main-content">
    <div class="wrapper">
        <h1>Todays Bookings</h1>

        <Br><br>
        <br><br>

        <!-- Add the "Refresh Booking" button -->
        <button id="refreshButton" class="primarybtn">Refresh Booking</button>

        <Br><br>
        <Br><br>

        <table class='tbl-full'>
            <tr>
                <th>S.N</th>
                <th>full_name</th>
                <th>email</th>
                <th>slot_id</th>
                <th>date</th>
                <th>start time</th>
                <th>end time</th>
                <th>price paid</th>
            </tr>

            <?php
            // Query to get and display the list of bookings
            $sql = "SELECT * FROM tbl_booking";
            $res = mysqli_query($conn, $sql);
            if ($res == TRUE) {
                $count = mysqli_num_rows($res); // Get the number of bookings
                $sn = 1;
                if ($count > 0) {
                    // There is data in the database
                    // Fetching data row by row from the database
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['b_id'];
                        $full_name = $rows['full_name'];
                        $email = $rows['email'];
                        $s_id = $rows['s_id'];
                        $date = $rows['s_date'];
                        $start_time = $rows['start_time'];
                        $end_time = $rows['end_time'];
                        $price = $rows['price'];

                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $s_id; ?></td>
                            <td><?php echo $date; ?></td>
                            <td><?php echo $start_time; ?></td>
                            <td><?php echo $end_time; ?></td>
                            <td><?php echo $price; ?></td>
                        </tr>
                    <?php
                    }
                } else {
                    // No data in the database
                }
            }
            ?>
        </table>
    </div>
</div>
<!-- main-content section ends-->

<script>
$(document).ready(function() {
    // Attach a click event handler to the "Refresh Booking" button
    $('#refreshButton').click(function() {
        // Send an AJAX request to delete_old_bookings.php
        $.ajax({
            type: 'POST',
            url: 'delete_old_bookings.php',
            success: function(data) {
                // Reload the bookings table on success
                $('.tbl-full').load('manage_booking.php .tbl-full');
            },
            error: function() {
                alert('Error refreshing bookings.');
            }
        });
    });
});
</script>

<?php include('partials/footer.php'); ?>