<?php
include '../includes/database.php';
session_start();
if (!$_SESSION['admin']) {
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
  <title>Administrator Portal</title>
  <link href="../assets/css/bootstrap4.min.css" rel="stylesheet">
  <link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/css/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="../assets/css/sb-admin.min.css" rel="stylesheet">
  </head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="../home.php">Placement Cell</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Applications">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Applications</span></a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li><a href="#awaiting" onclick="awaiting()">Awaiting</a></li>
            <li><a href="#approved" onclick="approved()">Approved</a></li>
            <li><a href="#confirmed" onclick="confirmed()">Confirmed</a></li>
            <li><a href="#rejected" onclick="rejected()">Rejected</a></li>
          </ul></li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reports">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
              <i class="fa fa-fw fa-area-chart"></i>
              <span class="nav-link-text">Reports</span></a>
            <ul class="sidenav-second-level collapse" id="collapseMulti">
              <li><a href="#placed" onclick="placed()">Placement</a></li>
              <li><a href="#report" onclick="report()">Recruitment</a></li>
          </li></ul></ul>

      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a></li></ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Sign Out</a>
        </li></ul></div>
  </nav>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Welcome Admin</li>
      </ol>

      <div class="card mb-3" id="data">

      </div>

    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Akash Krishna</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <form class="" action="../includes/logout.php" method="post">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sign Out</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button></div>
          <div class="modal-body">Are you sure you want to end your current session?</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit" name="logout">Logout</button>
          </div></div></div></div></form></div></div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/jquery.dataTables.js"></script>
    <script src="../assets/js/dataTables.bootstrap4.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery.easing.min.js"></script>
    <script src="../assets/js/sb-admin.min.js"></script>
    <script src="../assets/js/bootstrapAlert.js"></script>

    <script type="text/javascript">
    switch (document.location.hash) {
      case '#awaiting': awaiting(); break;
      case '#approved': approved(); break;
      case '#confirmed': confirmed(); break;
      case '#rejected': rejected(); break;
      case '#placed': placed(); break;
      case '#report': report(); break;
      default: awaiting();
    }

    function awaiting(){$('#data').load('../includes/datatable.php?type=awaiting');}
    function approved(){$('#data').load('../includes/datatable.php?type=approved');}
    function confirmed(){$('#data').load('../includes/datatable.php?type=confirmed');}
    function rejected(){$('#data').load('../includes/datatable.php?type=rejected');}
    function placed(){$('#data').load('../includes/datatable.php?type=placed');}
    function report(){$('#data').load('../includes/datatable.php?type=report');}
    </script>
  </body>
</html>

  <?php if (strpos($fullurl, "approved") == true) {
    echo "<script>$(document).ready(function(){BootstrapAlert.success({title: \"Application Approved!\", message: \"The application is sent to the eligible students\"});});</script>"; }
    elseif (strpos($fullurl, "rejected") == true) {
  echo "<script>$(document).ready(function(){BootstrapAlert.alert({title: \"Application rejected!\", message: \"The application is moved to the rejected list\"});});</script>"; }
  elseif (strpos($fullurl, "confirmed") == true) {
    echo "<script>$(document).ready(function(){BootstrapAlert.success({title: \"Recruitment Confirmed!\", message: \"The recruiter can now upload the recruitment results\"});});</script>"; }
    ?>
