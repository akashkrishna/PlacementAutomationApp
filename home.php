<?php
include 'includes/database.php';
session_start();
      if (isset($_SESSION['logrec'])) {
          header("LOCATION: portal/recruiter.php");
          exit();
          }
      elseif (isset($_SESSION['logstu'])) {
              header("LOCATION: portal/student.php");
              exit();
              }
      elseif (isset($_SESSION['admin'])) {
                      header("LOCATION: portal/admin.php");
                      exit();
                  }
$sql = "SELECT * FROM jobs WHERE status='1' AND ld>='$date' AND rd>'$date'";
$res = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en" oncontextmenu="return false">
    <head>
      <noscript>
        <style>html{display:none;}</style>
        <meta http-equiv="refresh" content="0; url=includes/js.html">
      </noscript>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Placement Cell</title>
        <link rel="stylesheet" href="assets/css/roboto.css">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		    <link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/sweetalert.min.css">
        <link rel="stylesheet" href="assets/css/animate.min.css">
    </head>

    <body onload="document.login.un.focus()">
            <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1 class="flipInX animated">Welcome to the Placement Cell</h1></div>

                        <div class="col-sm-5">
                        	<div class="form-box">
	                        	<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Login to access</h3>
	                            		<p><strong><em>Recruiter enter email and password:</em></strong></p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-lock"></i>
	                        		</div></div>
	                            <div class="form-bottom">
				                    <form name="login" action="includes/login.php" method="post" class="login-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="un">Username</label>
                                  <input type="text" placeholder="Username" class="form-username form-control" name="un" required title="Students, enter your valid register number as the username">
                                  <span class="error">
                                    <?php if (strpos($fullurl, "login=nreg") == true) {
                                          echo '<font color=red>User not found...!</font>';
                                        }?></span></div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="pw">Password</label>
                                  <input type="password" placeholder="Password" class="form-password form-control" name="pw" required title="Students, your DOB should be entered as DD/MM/YYYY for password">
                                  <span class="error">
                                      <?php if (strpos($fullurl, "login=pwde") == true) {
                                            echo '<font color=red>Password doesn\'t match...!</font>';
                                          }?></span></div>
				                        <button type="submit" class="btn" id="sin" name="login" title="Click to login">Sign In</button>
				                    </form></div></div>
                            <div class="recruiter">
                                  <div class="recruiter-button">
                                    <a class="btn btn-link-2" href="portal/register.php"  title="Click to signup">
                                      <i class="fa fa-users"></i>Recruiter Registration
                                    </a></div></div></div>

                        <div class="col-sm-1 middle-border"></div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-5">
                        	<div class="form-box">
                        		<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>New Notifications</h3>
	                            		<p>Click on for more details:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-bell"></i>
	                        		</div></div>
	                            <div class="form-bottom">
				                        <marquee direction="up" scrollamount="4" onmouseover="stop();" onmouseout="start();">
                                  <?php if (mysqli_num_rows($res)>0) {
                                    while ($row = mysqli_fetch_assoc($res)) {
                                    $cmp="SELECT * FROM rec WHERE ema='".$row['con']."'";
                                    $com=mysqli_fetch_assoc(mysqli_query($con, $cmp));?>
                                  <a title="Click on for more details" href="#login" id="log"><?php echo $com['com']." Campus Recruitment for ".$row['deg']; ?></a><hr>
                                <?php }} else { ?>
                                  <h4>No New Notifications<h4><br>
                                    <h4>Please Visit later...</h4><br>
                              <?php } ?></marquee>
				                    </div></div></div></div></div></div></div>

        <footer>
        	<div class="container">
        		<div class="row">
        			<div class="col-sm-8 col-sm-offset-2">
        				<div class="footer-border"></div>
        				<p>Akash Krishna</p>
        			</div></div></div>
        </footer>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script>$(document).ready(function(){$.backstretch("assets/img/1.jpg");});</script>
        <script>$('#log').click(function(){$('#sin').click();})</script>
        <script src="assets/js/sweetalert.min.js"></script>
    </body>
</html>

<?php if (strpos($fullurl, "signup=success") == true) {
        echo "<script>swal(\"Registered!\", \"Please login to proceed...\", \"success\")</script>"; }
      elseif (strpos($fullurl, "login=error") == true) {
        echo "<script>swal(\"Sign In!\", \"Please login to proceed...\", \"error\")</script>"; }
 ?>
