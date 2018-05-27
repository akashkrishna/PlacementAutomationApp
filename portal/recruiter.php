<?php
include '../includes/database.php';
session_start();
if (!$_SESSION['logrec']) {
    header("LOCATION: ../includes/logout.php");
    exit();
    }
 ?>

<!DOCTYPE html>
<html lang="en">
<head><meta charset="utf-8">
  <noscript>
    <style>html{display:none;}</style>
    <meta http-equiv="refresh" content="0; url=../includes/js.html">
  </noscript>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Recruiter Dashboard</title>
  <link href="../assets/css/bootstrap4.min.css" rel="stylesheet">
  <link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/css/sb-admin.min.css" rel="stylesheet">
  <link href="../assets/css/multiselect.css" rel="stylesheet">
  <link href="../assets/css/sweetalert.min.css" rel="stylesheet" type="text/css">
  <script src="../assets/js/sweetalert.min.js"></script>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">

  <?php if (strpos($fullurl, "post=success") == true) {
    echo "<script>swal(\"Application Submitted!\", \"The placement officer will contact you for confirmation...\", \"success\")</script>";
      }?>

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
          <a class="nav-link text-center" id="sidenavToggler"  title="Toggle navigation panel">
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
          <form name="app" action="../includes/application.php" method="post" onsubmit="return verify()">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
            <label for="po">Designation</label>
                <input class="form-control" name="po" type="text" placeholder="Enter Position Offering" required pattern="[A-Z a-z]+" title="Enter valid Designation"></div>
              <div class="col-md-6">
                <label for="cp">Compensation</label>
                <input class="form-control" name="cp" type="number" placeholder="Enter Compensation Offering (per annum in INR)" required min="0" title="Enter the salary amount you're oferring">
                </div></div></div>

              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                  <label for="de">Degree</label>
                  <div class="selectBox" onclick="showCheckboxes()">
                      <select class="form-control" name="de">
                        <option selected disabled hidden value="">Select an option</option>
                      </select>
                      <div class="overSelect"></div></div>

                      <div id="checkboxes">
                        <input id="ug" name="degree[]" type="checkbox" value="UG" title="Undergraduate Students">UG<br>
                        <input id="pg" name="degree[]" type="checkbox" value="PG" title="Postgraduate Students">PG<br>
                        <input id="phd" name="degree[]" type="checkbox" value="PHD" title="Research Students">Research
                        </div></div>

                          <div class="col-md-6">
                          <label for="bc">Branch</label>
                          <div class="selectBox" onclick="scb()">
                              <select class="form-control" name="bc">
                                <option selected disabled hidden value="">Select an option</option>
                              </select>
                              <div class="overSelect"></div></div>

                              <div id="cb">
                                <input id="cs" name="branch[]" type="checkbox" value="Computer Applications">Computer Applications<br>
                                <input id="m" name="branch[]" type="checkbox" value="Maths">Maths<br>
                                <input id="s" name="branch[]" type="checkbox" value="Statistics">Statistics<br>
                                <input id="p" name="branch[]" type="checkbox" value="Physics">Physics<br>
                                <input id="ch" name="branch[]" type="checkbox" value="Chemistry">Chemistry<br>
                                <input id="cm" name="branch[]" type="checkbox" value="Commerce">Commerce<br>
                                <input id="ba" name="branch[]" type="checkbox" value="Business Administration">Business Administration<br>
                                </div></div></div></div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
            <label for="x">10th</label>
            <input class="form-control" name="x" type="number" placeholder="Enter X % Required" required max="100" min="35" title="Enter valid 10th mark required">
            </div>
            <div class="col-md-6"><label for="xii">12th</label>
            <input class="form-control" name="xii" type="number" placeholder="Enter XII % Required" required max="100" min="35" title="Enter valid 12th mark required">
          </div></div></div>

          <div class="form-group">
            <div class="form-row">
          <div class="col-md-6"><label for="agg">Aggregate</label>
          <input class="form-control" name="agg" type="number" placeholder="Enter Aggregate Required" required max="100" min="0" title="Enter valid degree aggregate required">
          </div>
          <div class="col-md-6"><label for="arr">Arrears</label><br>
            <select class="form-control" name="arr" required>
              <option disabled selected hidden value="">Select an Option</option>
              <option value="0">Not Allowed</option>
              <option value="1">Allowed</option>
            </select>
        </div></div></div>

        <div class="form-group">
          <div class="form-row">
        <div class="col-md-6"><label for="ld">Apply By</label>
        <input class="form-control" name="ld" type="date" required min="<?php echo $date; ?>" max="<?php echo date('Y');?>-12-31" title="Enter valid last date to apply">
        </div>
        <div class="col-md-6"><label for="rd">Recruitment Date</label>
          <input class="form-control" name="rd" type="date" required min="<?php echo $date; ?>" max="<?php echo date('Y');?>-12-31" title="Enter preferred date of recruitment">
      </div></div></div>

          <div class="form-group"><label for="info">Additional Information</label>
            <textarea name="info" class="form-control" placeholder="Enter if any other additional information regarding the recruitment" rows="5" cols="5" name="info" title="Enter all other related information"></textarea>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <input type="reset" class="btn btn-secondary btn-block" value="Reset" title="Clear all entered values"></div>
          <div class="col-md-6">
            <button type="submit" class="btn btn-primary btn-block" name="submit" value="<?php echo $_SESSION['eid']; ?>" title="Submit the application">Submit</button>
        </div></div></div></form></div>

    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Akash Krishna</small></div></div>
    </footer>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top" title="Go up">
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

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/verify.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery.easing.min.js"></script>
    <script src="../assets/js/sb-admin.min.js"></script>
  </body>
  </html>
