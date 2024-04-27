<?php 
    include '../include/connect_sql.php';
    include '../redirect.php';
    session_start();
    
    if (isset($_POST['btnsave'])) {
        $title = $_POST['txttile'];
        $subject = $_POST['txtsubject'];

        $qryinsert = $conn->query("Insert into tblannounce(title,subj) Values('$title','$subject')") or die($conn->error);
        if ($qryinsert) {
             echo '<script>alert("Announcements Successfully Added");</script>';
        }
    }
    
    $qryann = $conn->query("Select * from tblannounce") or die($conn->error);
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
          <h1><i class="bi bi-speedometer"></i> Dashboard</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"><a href="../admin/dashboard.php">Dashboard</a></li>
        </ul>
      </div>
         <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Welcome</h3>
            <div  style="height: 30px">
             <h4>Vehicle Booking Management System</h4>
            </div>
          </div>
        </div>
        <div class="col-md-12 mb-2">
            <button type="button" data-bs-toggle="modal" data-bs-target="#modalannounce" class="btn btn-primary btn-sm mb-2"> <i class="bi bi-plus-circle"></i> Announcement</button>
        </div>
            <?php 
            

            while ($rowannounce = $qryann->fetch_assoc()) {
            echo '<div class="col-md-12">
               <div class="card">
                   <div class="card-body">
                      <p><b>'.$rowannounce['title'].'</b><br>'.$rowannounce['subj'].'</p>
                   </div>
               </div>
           </div>';
        }
         ?>
         
           
        </div>
      </div>
    </main>
     <!-- Modal -->
        <div class="modal fade" id="modalannounce" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    <label>Title</label>
                    <input type="text" class="form-control form-control-sm" name="txttile">
                  </div>
                  <div class="col-md-12">
                    <label>Subject</label>
                    <input type="text" class="form-control form-control-sm" name="txtsubject">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="btnsave" class="btn btn-primary">Save</button>
              </div>
              </form>
            </div>
          </div>
        </div>

	<?php include 'js.php'; ?>
	 <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
</body>
</html>