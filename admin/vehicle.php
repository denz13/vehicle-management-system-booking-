<?php 
  include '../include/connect_sql.php';
  include '../redirect.php';
  session_start();
  if (isset($_POST['btnsave'])) {
    $type = $_POST['cmbtype'];
    $plate = $_POST['txtplate'];
    $color = $_POST['txtcolor'];
    $capacity = $_POST['txtcapacity'];
    $rental = $_POST['txtrental'];
    $image = $_FILES['txtimage']['tmp_name'];
    $imgContent = addslashes(file_get_contents($image));

    $targetDirectory = "../uploads/"; // Directory where images will be stored
    $targetFile = $targetDirectory . basename($_FILES["txtimage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    }else{
      if (move_uploaded_file($_FILES["txtimage"]["tmp_name"], $targetFile)) {
            $imageName = $_FILES["txtimage"]["name"];
            $filePath = $targetDirectory . $imageName;

             $qryinsert = $conn->query("Insert into tblvehicle(vehicle_type,plate,color,capacity,renatal,image) Values('$type','$plate','$color','$capacity','$rental','$imageName')") or die($conn->error);

              if ($qryinsert) {
      echo '<script>alert("Vehicle Successfully Added");</script>';
    }
      }
    }


   
  }

  $qryloadvehicle = $conn->query("Select * from tblvehicle") or die($conn->error);
  
  if(isset($_POST['btnupdate'])) {
    $vehicleid = $_POST['txtid'];
    $type = $_POST['cmbtype'];
    $plate = $_POST['txtplate'];
    $color = $_POST['txtcolor'];
    $capacity = $_POST['txtcapacity'];
    $rental = $_POST['txtrental'];

    // Check if file is uploaded
    if(isset($_FILES['txtimage']) && $_FILES['txtimage']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['txtimage']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));

        $targetDirectory = "../uploads/"; // Directory where images will be stored
        $targetFile = $targetDirectory . basename($_FILES["txtimage"]["name"]);

        // Move uploaded file to target directory
        if (move_uploaded_file($_FILES["txtimage"]["tmp_name"], $targetFile)) {
            // File uploaded successfully
            // Proceed with database update
            $qryinsert = $conn->query("UPDATE tblvehicle SET vehicle_type='$type', plate='$plate', color='$color', capacity='$capacity', renatal='$rental', image='$imgContent' WHERE vehicleid='$vehicleid'") or die($conn->error);
            if ($qryinsert) {
                echo '<script>alert("Updated Successful");</script>';
                 echo '<script>window.location.href = window.location.href;</script>';
            } else {
                echo '<script>alert("Failed to update. Please try again.");</script>';
            }
        } else {
            echo '<script>alert("Sorry, there was an error uploading your file.");</script>';
        }
    } else {
        // File not uploaded
        // Proceed with database update without changing the image
        $qryinsert = $conn->query("UPDATE tblvehicle SET vehicle_type='$type', plate='$plate', color='$color', capacity='$capacity', renatal='$rental' WHERE vehicleid='$vehicleid'") or die($conn->error);
        if ($qryinsert) {
            echo '<script>alert("Updated Successful");</script>';
             echo '<script>window.location.href = window.location.href;</script>';
        } else {
            echo '<script>alert("Failed to update. Please try again.");</script>';
        }
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
          <h1><i class="bi bi-bus-front-fill"></i> Vehicle</h1>
          <p>Vehicle Booking</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item">Booking Management</li>
          <li class="breadcrumb-item active"><a href="../admin/vehicle.php">Vehicle</a></li>
        </ul>
      </div>

      <div class="row justify-content-center">
        <div class="col-md-12">
            <div>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modalvehicle" class="btn btn-primary btn-sm mb-2"> <i class="bi bi-plus-circle"></i> Vehicle</button>
            </div>
            <div class="title">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th style="display:none"></th>
                                    <th>Vehicle Type</th>
                                    <th>Plate #</th>
                                    <th>Color</th>
                                    <th>Capacity</th>
                                    <th>Rental Fee</th>
                                    <th>Date Added</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    while ($rowvehicle = $qryloadvehicle->fetch_assoc()) {
                                        echo '<tr>
                                                <td style="display:none;">'.$rowvehicle['vehicleid'].'</td>
                                                <td>'.$rowvehicle['vehicle_type'].'</td>
                                                <td>'.$rowvehicle['plate'].'</td>
                                                <td>'.$rowvehicle['color'].'</td>
                                                <td>'.$rowvehicle['capacity'].'</td>
                                                <td>'.$rowvehicle['renatal'].'</td>
                                                <td>'.$rowvehicle['dt_vehicle'].'</td>
                                                <td><button type="button" data-bs-toggle="modal" data-bs-target="#modalupdate" class="btn btn-primary btn-sm getid3">Edit</button</td>
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
    <!-- main content -->

 

        <!-- Modal -->
        <div class="modal fade" id="modalvehicle" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Vehicle</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <label>Vehicle Type</label>
                    <select class="form-control form-control-sm mb-2" name="cmbtype">
                      <option disabled selected>Select Option</option>
                      <option>Van</option>
                      <option>Pick Up</option>
                      <option>Elf Truck</option>
                      <option>Mini Van</option>
                      <option>SUVs</option>
                    </select>
                  </div>
                  <div class="col-md-12">
                    <label>Plate #</label>
                    <input type="text" class="form-control form-control-sm" name="txtplate">
                  </div>
                  <div class="col-md-12">
                    <label>Color</label>
                    <input type="text" class="form-control form-control-sm" name="txtcolor">
                  </div>
                  <div class="col-md-12">
                    <label>Capacity</label>
                    <input type="text" class="form-control form-control-sm" name="txtcapacity">
                  </div>
                  <div class="col-md-12">
                    <label>Rental Fee</label>
                    <input type="text" class="form-control form-control-sm" name="txtrental">
                  </div>
                  <div class="col-md-12">
                    <label>Upload Image</label>
                    <input type="file" class="form-control form-control-sm" accept="image/*" name="txtimage">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="btnsave" class="btn btn-primary">Save Vehicle</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        
         <!-- Modal -->
        <div class="modal fade" id="modalupdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Vehicle Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="txtid" name="txtid">
                  <div class="col-md-12">
                    <label>Vehicle Type</label>
                    <select class="form-control form-control-sm mb-2" name="cmbtype" id="cmbtype">
                      <option disabled selected>Select Option</option>
                      <option>Van</option>
                      <option>Pick Up</option>
                      <option>Elf Truck</option>
                      <option>Mini Van</option>
                      <option>SUVs</option>
                    </select>
                  </div>
                  <div class="col-md-12">
                    <label>Plate #</label>
                    <input type="text" class="form-control form-control-sm" name="txtplate" id="txtplate">
                  </div>
                  <div class="col-md-12">
                    <label>Color</label>
                    <input type="text" class="form-control form-control-sm" name="txtcolor" id="txtcolor">
                  </div>
                  <div class="col-md-12">
                    <label>Capacity</label>
                    <input type="text" class="form-control form-control-sm" name="txtcapacity" id="txtcapacity">
                  </div>
                  <div class="col-md-12">
                    <label>Rental Fee</label>
                    <input type="text" class="form-control form-control-sm" name="txtrental" id="txtrental">
                  </div>
                  <div class="col-md-12">
                    <label>Upload Image</label>
                    <input type="file" class="form-control form-control-sm" accept="image/*" name="txtimage" id="txtimage">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="btnupdate" class="btn btn-primary">Update Vehicle</button>
              </div>
              </form>
            </div>
          </div>
        </div>
	<?php include 'js.php'; ?>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
           $(document).ready(function () {
        $(document).on('click','.getid3', function(e) {
          $('#modalupdate').modal('show');

          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();
          console.log(data);
          $('#txtid').val(data[0]);
           $('#cmbtype').val(data[1]);
           $('#txtplate').val(data[2]);
            $('#txtcolor').val(data[3]);
            $('#txtcapacity').val(data[4]);
            $('#txtrental').val(data[5]);
        });
      });
</script>
</body>
</html>