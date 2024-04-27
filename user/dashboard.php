<?php 
    include '../include/connect_sql.php'; 
    include '../redirect.php';
    session_start();
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
<body  class="app sidebar-mini">
    <?php include 'navbar.php'; ?>
    <?php include 'sidebar.php'; ?>
     <main class="app-content">
         <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Welcome</h3>
            <div class="ratio  ratio-16x9" style="height: 30px">
             <h4>Vehicle Booking Management System</h4>
            </div>
          </div>
        </div>
        <?php 
            $qryann = $conn->query("Select * from tblannounce") or die($conn->error);

            while ($rowannounce = $qryann->fetch_assoc()) {
                echo '<div class="col-md-12">
                      <div class="tile">
                        <h3 class="tile-title">Announcement</h3>
                        <div class="ratio ratio-16x9" style="height: 60px">
                          <p><b>'.$rowannounce['title'].'</b><br>'.$rowannounce['subj'].'</p>
                        </div>
                      </div>';
            }
         ?>
        
        </div>
      </div>
    </main>

	<?php include 'js.php'; ?>
</body>
</html>