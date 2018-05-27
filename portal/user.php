<?php
include '../includes/database.php';
session_start();
if ($_SESSION['logrec']) {
    $sql = "SELECT * FROM rec WHERE ema='".$_SESSION['eid']."'";
    $res = mysqli_fetch_assoc(mysqli_query($con, $sql));
  }
  else {
    header("LOCATION: ../includes/logout.php");
    exit();
    }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <noscript>
    <style>html{display:none;}</style>
    <meta http-equiv="refresh" content="0; url=../includes/js.html">
  </noscript>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Recruiter Dashboard</title>
  <link href="../assets/css/bootstrap4.min.css" rel="stylesheet">
  <link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/css/sb-admin.min.css" rel="stylesheet">
  <link href="../assets/css/sweetalert.min.css" rel="stylesheet" type="text/css">
  <script src="../assets/js/sweetalert.min.js"></script>
  </head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">

  <?php if (strpos($fullurl, "invalid") == true) {
    echo "<script>swal(\"Invalid Password!\", \"You've entered the current password wrong\", \"error\")</script>"; }
    elseif (strpos($fullurl, "none") == true) {
      echo "<script>swal(\"No update!\", \"You've changed nothing to update\", \"error\")</script>"; }
      elseif (strpos($fullurl, "pwup") == true) {
        echo "<script>swal(\"Password Updated!\", \"Your account password is updated sucessfully\", \"success\")</script>"; }
          elseif (strpos($fullurl, "phup") == true) {
            echo "<script>swal(\"Contact Updated!\", \"Your phone number is updated sucessfully\", \"success\")</script>";}
              elseif (strpos($fullurl, "changed") == true) {
                echo "<script>swal(\"Credentials Changed!\", \"The contact details and the password are updated sucessfully\", \"success\")</script>"; }
      ?>

  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="../home.php">Placement Cell</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Recruit">
          <a class="nav-link" href="recruiter.php" target="_self" title="Post Job">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Recruitment</span>
          </a></li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Applications">
            <a class="nav-link" href="posted.php" target="_self" title="Posted Jobs">
              <i class="fa fa-fw fa-pencil-square-o"></i>
              <span class="nav-link-text">Applications</span>
            </a></li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Account">
              <a class="nav-link" href="user.php" title="Settings">
                <i class="fa fa-fw fa-user-circle"></i>
                <span class="nav-link-text">Account</span>
              </a></li></ul>

      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler" title="Toggle navigation panel">
            <i class="fa fa-fw fa-angle-left"></i>
          </a></li></ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal" title="Logout Session">
            <i class="fa fa-fw fa-sign-out"></i>Sign Out</a>
        </li></ul></div>
  </nav>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Welcome <?php
        echo $_SESSION['id'];
         ?></li>
      </ol>

  <div class="container" id="main">
          <form name="acc" action="../includes/application.php" method="post" onsubmit="return verify()">
            <div class="form-group">
              <label for="id">Company</label>
                  <input class="form-control" name="cm" type="text" disabled value="<?php echo $res['com'];?>"></div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
            <label for="id">Name</label>
                <input class="form-control" name="nm" type="text" disabled value="<?php echo $res['nam'];?>"></div>
              <div class="col-md-6">
                <label for="nm">Designation</label>
                <input class="form-control" name="dn" type="text" disabled value="<?php echo $res['des'];?>">
                </div></div></div>

        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6"><label for="em">Email</label>
              <input class="form-control" name="em" required type="email" disabled value="<?php echo $res['ema'];?>"></div>
        <div class="col-md-6"><label for="ph">Phone</label>
        <input class="form-control" name="ph" required type="number" value="<?php echo $res['cno'];?>" maxlength="10" min="1" title="Contact Number">
      </div></div></div>

          <div class="form-group"><label for="opw">Current Password</label>
            <input type="password" name="opw" class="form-control" required placeholder="Enter your current password" title="Enter your current password">
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6"><label for="npw">New Password</label>
                <input type="password" name="npw" class="form-control" placeholder="Enter new password if you want to change" minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
              </div>
                <div class="col-md-6"><label for="cpw">Confirm Password</label>
                  <input type="password" name="cpw" class="form-control" placeholder="Reenter the password you want to change" minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                </div></div></div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <input type="reset" class="btn btn-secondary btn-block" value="Reset" title="Clear all entered values"></div>
          <div class="col-md-6">
            <button type="submit" class="btn btn-primary btn-block" name="user" value="<?php echo $_SESSION['eid']; ?>" title="Update Information">Update</button>
        </div></div></div></form></div>

    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Akash Krishna</small></div></div>
    </footer>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top" title="Go Up">
      <i class="fa fa-angle-up"></i></a>

    <!-- Logout Modal-->
    <form class="" action="../includes/logout.php" method="post">
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sign Out</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close" title="Close Window">
              <span aria-hidden="true">×</span>
            </button></div>
          <div class="modal-body">Are you sure you want to end your current session?</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal" title="Close window">Cancel</button>
            <button class="btn btn-primary" type="submit" name="logout" title="Sign Out">Logout</button>
          </div></div></div></div></form></div></div>

          <script type="text/javascript">
            function verify() {
                if (acc.npw.value!=acc.cpw.value) {
                    document.acc.cpw.value="";
                    document.acc.npw.value="";
                    document.acc.npw.focus();
                    swal("Password Mismatch!", "Please verify and reenter the passwords...", "error");
                    return false; }
                  else if (acc.opw.value==acc.npw.value) {
                    document.acc.cpw.value="";
                    document.acc.npw.value="";
                    document.acc.npw.focus();
                    swal("Invalid Password!", "You've entered the current password as new password", "error");
                    return false; }}
          </script>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery.easing.min.js"></script>
    <script src="../assets/js/sb-admin.min.js"></script>
  </body>
  </html>
