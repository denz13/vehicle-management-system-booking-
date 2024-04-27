<?php 
    include '../connect_sql.php';
    include '../redirect.php';
    session_start();

    
    $qryloadapproved = $conn->query("SELECT * FROM tblreserve INNER JOIN tblvehicle ON tblvehicle.vehicleid=tblreserve.vehicle_id") or die($conn->error);
    if (isset($_POST['btncancel'])) {
    $reserveid = $_POST['txtcancelid'];
    $remarks  = 'Cancelled';

    $qryinsert = $conn->query("Update tblreserve set status='".$remarks."' where reserveid='".$reserveid."'") or die($conn->error);

    if ($qryinsert) {
       echo '<script>alert("Reservation has been Cancelled");</script>';
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 5, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 5 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 5, SASS and PUG.js. It's fully customizable and modular.">
    <title>Vehicle Booking Management System</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Include CSS files -->
    <?php include 'css.php'; ?>
</head>
<body class="app sidebar-mini">
    <!-- Include navigation and sidebar -->
    <?php include 'navbar.php'; ?>
    <?php include 'sidebar.php'; ?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="bi bi-bus-front-fill"></i> Vehicle</h1>
                <p>Vehicle Booking</p>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
                <li class="breadcrumb-item">Booking Management</li>
                <li class="breadcrumb-item active"><a href="../admin/booking.php">Booking Details</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="title">
                    <div class="tile-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th style="display: none;"></th>
                                        <th>Vehicle Type</th>
                                        <th>Plate #</th>
                                        <th>From</th>
                                        <th>Destination</th>
                                        <th>Departure Date</th>
                                        <th>Returned Date</th>
                                        <th>Date Reserve</th>
                                        <th>Status</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        while ($rowloadreservation = $qryloadapproved->fetch_assoc()) {
                                            // Determine the remarks based on the status
                                            if ($rowloadreservation['status'] === 'Approved') {
                                            $remarks = '<span style="color: green;">Please visit the station for the payment process</span>';
                                            } else if ($rowloadreservation['status'] === 'Cancelled') {
                                            $remarks = '<span style="color: red;">You cancelled your booking</span>';
                                        } else {
                                            $remarks = ''; // Handle other statuses if needed
                                        }
    
                                            // Check if the status is either "Cancelled" or "Approved" to disable the cancel button
                                            $cancelButtonDisabled = $rowloadreservation['status'] === 'Cancelled' || $rowloadreservation['status'] === 'Approved' ? 'disabled' : '';

                                            // Display the table row with the appropriate remarks and disabled status
                                            echo '<tr>
                                            <td style="display:none">'.$rowloadreservation['reserveid'].'</td>
                                            <td>'.$rowloadreservation['vehicle_type'].'</td>
                                            <td>'.$rowloadreservation['plate'].'</td>
                                            <td>'.$rowloadreservation['from1'].'</td>
                                            <td>'.$rowloadreservation['destination'].'</td>
                                            <td>'.$rowloadreservation['departure'].'</td>
                                            <td>'.$rowloadreservation['returned'].'</td>
                                            <td>'.$rowloadreservation['dt_reserve'].'</td>
                                            <td>'.$rowloadreservation['status'].'</td>
                                            <td>'.$remarks.'</td>
                                            <td><button type="button" data-bs-toggle="modal" data-bs-target="#modalcancel" class="btn btn-danger btn-sm approve-btn" '.$cancelButtonDisabled.'>Cancel</button></td>
                                            </tr>';
                                        }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </main>
    <!-- Include Modal and JavaScript -->
    <!-- Modal -->
    <div class="modal fade" id="modalcancel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <input type="hidden" id="cancelid" name="txtcancelid">
                        <p>Are you sure you want to cancel this booking ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="btncancel" class="btn btn-primary">Approved</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Include JavaScript files -->
    <?php include 'js.php'; ?>
    <script>
   $(document).ready(function(){
    $('.approve-btn').click(function(){
        // Get the reserveid from the table row
        var reserveId = $(this).closest('tr').find('td:first').text();
        // Populate the reserveid into the input field inside the modal
        $('#cancelid').val(reserveId);
        // Show the modal
        $('#modalcancel').modal('show');
        
        // Disable the cancel button
        $(this).prop('disabled', true);
    });
    
    // After the confirmation modal is closed, reload the current page
    $('#modalcancel').on('hidden.bs.modal', function () {
        window.location.reload();
    });
});

</script>
</body>
</html>
