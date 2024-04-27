<?php 
	include 'connect_sql.php';

	if (isset($_POST['btnregister'])) {
		$firstname = $_POST['txtfname'];
		$lastname = $_POST['txtlname'];
		$address = $_POST['txtaddress'];
		$bday = $_POST['txtbday'];
		$age = $_POST['txtage'];
		$sex = $_POST['cmbsex'];
		$username = $_POST['txtuser'];
		$passw = $_POST['txtpassw'];
		$role = "1";

		$qryregister = $conn->query("Insert into tbluser(firstname,lastname,address,bday,age,sex,username,passw,role) Values('$firstname','$lastname','$address','$bday','$age','$sex','$username','$passw','$role')") or die($conn->error);

		if ($qryregister) {
			 echo '<script>
			 			alert("Successfully Registered");
			 			window.location.href = "http://localhost:8080/vbms/login.php";
			      </script>';
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Vehicle Booking Management System</title>
	 <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
	<section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>Vehicle Booking Management System</h1>
      </div>
      <div class="login-box" style="width: 600px;height: 520px">
        <form class="login-form" method="post">
          <h3 class="login-head"><i class="bi bi-person me-2"></i>REGISTER</h3>
          <div class="row">
          <div class="col-md-6 mb-2">
            <label class="form-label">FIRSTNAME</label>
            <input name="txtfname" class="form-control" type="text" placeholder="Firstname" autofocus required>
          </div>
          <div class="col-md-6 mb-2">
            <label class="form-label">LASTNAME</label>
            <input name="txtlname" class="form-control" type="text" placeholder="Lastname" required>
          </div>
           <div class="col-md-6 mb-2">
            <label class="form-label">ADDRESS</label>
            <input name="txtaddress" class="form-control" type="text" placeholder="Home Address" required>
          </div>
           <div class="col-md-6 mb-2">
            <label class="form-label">Birthdate</label>
            <input name="txtbday" class="form-control" type="date" placeholder="Birthdate" required>
          </div>
          <div class="col-md-6 mb-2">
            <label class="form-label">AGE</label>
            <input class="form-control" type="number" name="txtage" placeholder="Age" required>
          </div>
          <div class="col-md-6 mb-2">
            <label class="form-label">Sex</label>
            <select class="form-control" name="cmbsex" required>
            	<option disabled selected>Select Option</option>
            	<option>Female</option>
            	<option>Male</option>
            </select>
          </div>
          <div class="col-md-6 mb-2">
            <label class="form-label">EMAIL</label>
            <input name="txtuser" class="form-control" type="email" placeholder="Email" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">PASSWORD</label>
            <input name="txtpassw" class="form-control" type="password" placeholder="Password" required>
          </div>
          </div>
          <div class="mb-3 btn-container d-grid">
            <button name="btnregister" type="submit" class="btn btn-primary btn-block"><i class="bi bi-box-arrow-in-right me-2 fs-5"></i>SIGN IN</button>
          </div>
          <div class="mb-3 btn-container d-grid">
             <button name="btnlogin" id="btnlogin" type="button" class="btn btn-primary btn-block">
            <i class="bi bi-box-arrow-in-right me-2 fs-5"></i>LOG IN
            </button>
          </div>
        </form>
        <!-- <form class="forget-form" action="index.html">
          <h3 class="login-head"><i class="bi bi-person-lock me-2"></i>Forgot Password ?</h3>
          <div class="mb-3">
            <label class="form-label">EMAIL</label>
            <input class="form-control" type="text" placeholder="Email">
          </div>
          <div class="mb-3 btn-container d-grid">
            <button class="btn btn-primary btn-block"><i class="bi bi-unlock me-2 fs-5"></i>RESET</button>
          </div>
          <div class="mb-3 mt-3">
            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="bi bi-chevron-left me-1"></i> Back to Login</a></p>
          </div>
        </form> -->
      </div>
    </section>

	<!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
      document.getElementById("btnlogin").addEventListener("click", function() {
        window.location.href = "login.php";
    });
    </script>
</body>
</html>