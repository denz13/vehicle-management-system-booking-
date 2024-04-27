<?php 
	include '../include/connect_sql.php';
	session_start();
	 

	 $qryloaduser = $conn->query("Select * from tbluser where id_user='".$_SESSION['customerid']."'") or die($conn->error);
	 $rowloaduser = $qryloaduser->fetch_array();

	 if (isset($_POST['btnupdate'])) {
	 	$firstname = $_POST['txtfname'];
		$lastname = $_POST['txtlname'];
		$address = $_POST['txtaddress'];
		$bday = $_POST['txtbday'];
		$age = $_POST['txtage'];
		$sex = $_POST['cmbsex'];
		$username = $_POST['txtuser'];
		$passw = $_POST['txtpassw'];

		$qryupdate = $conn->query("Update tbluser set firstname='$firstname',lastname='$lastname',address='$address', bday='$bday', sex='$sex', username='$username', passw='$passw' where id_user='".$_SESSION['customerid']."'") or die($conn->error);
		if ($qryupdate) {
			echo '<script>
			      alert("Account Successfully Updated");
			      window.location.href = window.location.href;
			      </script>';
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
          <h1><i class="bi bi-person-fill"></i> Profile</h1>
          <p>Account Details</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item">Account</li>
          <li class="breadcrumb-item active"><a href="../user/profile.php">Profile</a></li>
        </ul>
      </div>
      <form method="post">
      <div class="row">
      	<div class="col-md-12">
          <div class="title">
            <div class="tile-body">
               <div class="col-md-6 mb-2">
            <label class="form-label">FIRSTNAME</label>
            <input name="txtfname" class="form-control" value="<?php echo $rowloaduser['firstname']; ?>" type="text" placeholder="Firstname" autofocus>
          </div>
          <div class="col-md-6 mb-2">
            <label class="form-label">LASTNAME</label>
            <input name="txtlname" class="form-control" value="<?php echo $rowloaduser['lastname']; ?>" type="text" placeholder="Lastname">
          </div>
           <div class="col-md-6 mb-2">
            <label class="form-label">ADDRESS</label>
            <input name="txtaddress" class="form-control" value="<?php echo $rowloaduser['address']; ?>" type="text" placeholder="Home Address">
          </div>
           <div class="col-md-6 mb-2">
            <label class="form-label">Birthdate</label>
            <input name="txtbday" class="form-control" type="date" value="<?php echo $rowloaduser['bday']; ?>" placeholder="Birthdate">
          </div>
          <div class="col-md-6 mb-2">
            <label class="form-label">AGE</label>
            <input class="form-control" type="text" name="txtage" value="<?php echo $rowloaduser['age']; ?>" placeholder="Age">
          </div>
          <div class="col-md-6 mb-2">
            <label class="form-label">Sex</label>
            <select class="form-control" name="cmbsex">
            	<option disabled selected>Select Option</option>
            	<option>Female</option>
            	<option>Male</option>
            </select>
          </div>
          <div class="col-md-6 mb-2">
            <label class="form-label">EMAIL</label>
            <input name="txtuser" class="form-control" type="email" value="<?php echo $rowloaduser['username']; ?>" placeholder="Email">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">PASSWORD</label>
            <input name="txtpassw" class="form-control" type="password" value="<?php echo $rowloaduser['passw']; ?>" placeholder="Password">
          </div>
           <div class="col-md-6 mb-3">
            <button type="submit" name="btnupdate" class="btn btn-primary btn-sm">Update Account</button>
          </div>
          </form>
          </div> 
        </div>
      </div>
    </main>
    <!-- main content -->
</body>
</html>