<?php 
	include '../include/connect_sql.php';
	include '../redirect.php';
	session_start();

	$qryloadpic = $conn->query("Select * from tblvehicle") or die($conn->error);

	if (isset($_POST['btnsave'])) {
		$vehicleid = $_POST['txtid'];
		$userid = '1';
		$from = $_POST['txtfrom'];
		$destination = $_POST['txtdestination'];
		$departure = $_POST['txtdeparture'];
		$returned = $_POST['txtreturned'];
		$passenger = $_POST['txtpassenger'];
		$status = "Pending";

		$qryinsert = $conn->query("Insert into tblreserve(vehicle_id,user_id,from1,destination,departure,returned,passenger,status) Values('$vehicleid','$userid','$from','$destination','$departure','$returned','$passenger','$status')") or die($conn->error);
		if ($qryinsert) {
			 echo '<script>alert("Reservation Successfully Added");</script>';
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
	<?php include 'css.php'; ?>
</head>
<body class="app sidebar-mini">
	<?php include 'navbar.php'; ?>
    <?php include 'sidebar.php'; ?>
    <main class="app-content">
    	<div class="app-title">
        <div>
          <h1><i class="bi bi-bus-front-fill"></i> Vehicles</h1>
          <p>Book and Researve Vehicles</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item">Booking Management</li>
          <li class="breadcrumb-item"><a href="#">Vehicles</a></li>
        </ul>
      </div>

      <div class="row">
      	
     <?php 
            
      	while ($rowloadvehicle = $qryloadpic->fetch_assoc()) {
    $qryloadavail = $conn->query("Select count(*) as totalc from tblreserve where vehicle_id='".$rowloadvehicle['vehicleid']."' and status='Approved'") or die($conn->error);
    $rowcount = $qryloadavail->fetch_array();
    $avai = '';
    
    if($rowcount['totalc'] == "1") {
        $avai = "Not Available";
        $disabled = "disabled"; // Add disabled attribute if vehicle is not available
    } else {
        $avai = "Available";
        $disabled = ""; // No disabled attribute if vehicle is available
    }
    
    echo '<div class="col-md-6">
              <div class="tile">
                <h3 class="tile-title">'.$rowloadvehicle['vehicle_type'].'</h3>
                <img src="../uploads/'.$rowloadvehicle['image'].'" width="50%">
                <div class="tile-body">Capactity: '.$rowloadvehicle['capacity'].'<br> Renatal Fee: '.$rowloadvehicle['renatal'].' <br>
                    Availability: '.$avai.'
                </div>
                <div class="tile-footer"><a data-bs-id="'.$rowloadvehicle['vehicleid'].'" type="button" data-bs-toggle="modal" data-bs-target="#modalreserve" class="btn btn-primary reserve-btn '.$disabled.'" href="#"> <i class="bi bi-plus-circle"></i> Make Reservation</a></div>
              </div>
          </div>';
}

      	 ?>
      	  </div>
    </main>

     <!-- Modal -->
        <div class="modal fade" id="modalreserve" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Researvation Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="post">
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                  	<input type="hidden" id="vehicleIdInput" name="txtid">
                    <label>From</label>
                    <input type="text" class="form-control form-control-sm" name="txtfrom">
                  </div>
                   <div class="col-md-12">
                    <label>Destination</label>
                    <input type="text" class="form-control form-control-sm" name="txtdestination">
                  </div>
                   <div class="col-md-12">
                    <label>Date of Departure</label>
                    <input type="date" class="form-control form-control-sm" name="txtdeparture">
                  </div>
                   <div class="col-md-12">
                    <label>Date of Returned</label>
                    <input type="date" class="form-control form-control-sm" name="txtreturned">
                  </div>
                  <div class="col-md-12">
                    <label>No. of Passenger</label>
                    <input type="number" class="form-control form-control-sm" name="txtpassenger">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="btnsave" class="btn btn-primary">Add Reservation</button>
              </div>
              </form>
            </div>
          </div>
        </div>
	<?php include 'js.php'; ?>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
$(document).ready(function(){
    $('.reserve-btn').click(function(){
        // Check if the button is disabled
        if (!$(this).hasClass('disabled')) {
            // Get the vehicle ID from the data-bs-id attribute
            var vehicleId = $(this).data('bs-id');
            // Populate the vehicle ID into the input field inside the modal
            $('#vehicleIdInput').val(vehicleId);
            // Show the modal
            $('#modalreserve').modal('show');
        }
    });
});
</script>

</body>
</html>