<?php 
	include 'connect_sql.php';
	session_start();

	if (isset($_POST['btnlogin'])) {
		$resmsg = '';
			$username = trim($_POST['txtusername']);
			$password = trim($_POST['txtpassword']);
			$username = stripcslashes($username);
			$password = stripslashes($password);
			$username = mysqli_real_escape_string($conn,$username);
			$password = mysqli_real_escape_string($conn,$password);

			$query = $conn->query("Select * from tbluser where username='$username' and passw='$password'") or die($conn->error);
			$rowqrycustomer = $query->fetch_array();
			$customerfullname = $rowqrycustomer['firsname']." ".$rowqrycustomer['lastname'];
			$customerid  = $rowqrycustomer['id_user'];
			// $qryinstructor = $conn->query("Select * from tblinstructor where  username='$username' and passw_='$password'") or die($conn->error);
			// $rowinsname = $qryinstructor->fetch_array();
			// $instructorfullname = $rowinsname['ins_fname']." ".$rowinsname['ins_lname'];

            // $qryadmin = $conn->query("SELECT * FROM `tbl_user` where username='$username' and pass='$password'") or die($conn->error);

			

			if(mysqli_num_rows($query)==1) {
					if ($rowqrycustomer['role']=="0") {
						$_SESSION['loggedin'] = true;
		                $_SESSION['usr'] = $username;
		                $_SESSION['passw'] = $password;
		                $_SESSION['customername'] = $customerfullname;
		                $_SESSION['customerid'] = $customerid;
		                $_SESSION['role'] = "Administrator";
		                header('location: ../admin/dashboard.php');
					}else{
						$_SESSION['loggedin'] = true;
		                $_SESSION['usr'] = $username;
		                $_SESSION['passw'] = $password;
		                $_SESSION['customername'] = $customerfullname;
		                $_SESSION['customerid'] = $customerid;
		                $_SESSION['role'] = "Customer";
		                header('location: ../user/dashboard.php');
					}
					
			}else{
				echo '<script>alert("Invalid Username or Password");</script>';
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
      <div class="login-box" style="height:450px">
        <form class="login-form" method="post">
          <h3 class="login-head"><i class="bi bi-person me-2"></i>SIGN IN</h3>
          <div class="mb-3">
            <label class="form-label">USERNAME</label>
            <input class="form-control" name="txtusername" type="text" placeholder="Email" autofocus required>
          </div>
          <div class="mb-3">
            <label class="form-label">PASSWORD</label>
            <input class="form-control" name="txtpassword" type="password" placeholder="Password" required>
          </div>
          <div class="mb-3">
            <!-- <div class="utility">
              <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox"><span class="label-text">Stay Signed in</span>
                </label>
              </div>
              <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Forgot Password ?</a></p>
            </div> -->
          </div>
          <div class="mb-3 btn-container d-grid">
            <button type="submit" name="btnlogin" class="btn btn-primary btn-block mb-2"><i class="bi bi-box-arrow-in-right me-2 fs-5"></i>SIGN IN</button>
            <a type="button" class="btn btn-info btn-block" href="register.php"><i class="bi bi-pencil-square"></i> SIGN UP</a>
          </div>
          <div class="mb-3 btn-container d-grid">
            <button name="btnhome" id="btnhome" type="button" class="btn btn-primary btn-sm btn-block">
            <i class="bi bi-box-arrow-in-right me-2 fs-5"></i>HOME
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
      document.getElementById("btnhome").addEventListener("click", function() {
        window.location.href = "index.php";
    });
    </script>
</body>
</html>