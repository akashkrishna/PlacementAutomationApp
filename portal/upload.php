<?php
include '../includes/database.php';
session_start();
error_reporting(0);
if ($_POST['upload']) {
    $jid = mysqli_real_escape_string($con, $_POST['upload']);
  } elseif ($_SESSION['upres']) {
      $jid = mysqli_real_escape_string($con, $_SESSION['upres']);
  } else {
    header("LOCATION: ../includes/logout.php");
    exit(); }
    $sql = "SELECT * FROM applications WHERE jid=$jid";
    $res = mysqli_query($con, $sql);
    $dtl = "SELECT * FROM jobs WHERE jid=$jid";
    $det = mysqli_fetch_assoc(mysqli_query($con, $dtl));
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
  <link href="../assets/css/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="../assets/css/sb-admin.min.css" rel="stylesheet">
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/bootstrapAlert.js"></script>
  </head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php if (strpos($fullurl, "selected") == true) {
  echo "<script>$(document).ready(function(){BootstrapAlert.success({title: \"Student Selected!\", message: \"The student is selected as part of the recruitment process\"});});</script>"; }
  elseif (strpos($fullurl, "rejected") == true) {
    echo "<script>$(document).ready(function(){BootstrapAlert.alert({title: \"Student Rejected!\", message: \"The student is rejected as part of the recruitment process\"});});</script>"; } ?>
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
            </a></li><li class="nav-item" data-toggle="tooltip" data-placement="right" title="Account">
              <a class="nav-link" href="user.php" title="Settings">
                <i class="fa fa-fw fa-user-circle"></i>
                <span class="nav-link-text">Account</span>
              </a></li></ul>

      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler" title="Toggle Navigation Panel">
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
        <li class="breadcrumb-item">
          <a href="posted.php">Applications</a></li>
        <li class="breadcrumb-item active"><?php echo $det['pos'] ?></li>
      </ol>

    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i> Applied Candidates</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Degree</th>
                <th>Branch</th>
                <th>Email</th>
                <th>Result</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Degree</th>
                <th>Branch</th>
                <th>Email</th>
                <th>Result</th>
              </tr>
            </tfoot>
            <tbody>
              <?php while ($row = mysqli_fetch_assoc($res)) {
                $std = "SELECT * FROM stu WHERE reg='".$row['reg']."'";
                $stu=mysqli_fetch_assoc(mysqli_query($con, $std));
                $dchk = "SELECT rd FROM jobs WHERE jid='".$row['jid']."'";
                $dat = mysqli_fetch_assoc(mysqli_query($con, $dchk));
                ?>
                <tr>
                <td><?php echo $stu['reg']; ?></td>
                <td><?php echo $stu['nam']; ?></td>
                <td> <?php echo $stu['deg']; ?></td>
                <td><?php echo $stu['dep']; ?></td>
                <td><?php echo $stu['email']; ?></td>
                <td><?php if ($row['res']==='0' && $dat['rd']<=$date): ?>
                  <form action="../includes/application.php" method="post">
                    <input type="text" name="jid" value="<?php echo $row['jid'] ?>" hidden>
                    <button class="btn btn-primary" type="submit" name="select" value="<?php echo $stu['reg']; ?>" title="Select Student"><i class="fa fa-check-circle"></i></button>
                    <button class="btn btn-secondary" type="submit" name="notsel" value="<?php echo $stu['reg']; ?>" title="Reject Student"><i class="fa fa-times-circle"></i></button>
                     </form>
                   <?php elseif ($row['res']==='1'): ?>
                    <font color=green>Selected</font>
                  <?php elseif ($row['res']==='2'): ?>
                      <font color=red>Not Selected</font>
                <?php endif; ?>
              </td></tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer small text-muted">Last Updated: <?php echo date('l d/m/Y h:i:s A'); ?></div>
    </div>

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

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery.easing.min.js"></script>
    <script src="../assets/js/jquery.dataTables.js"></script>
    <script src="../assets/js/dataTables.bootstrap4.js"></script>
    <script src="../assets/js/sb-admin.min.js"></script>
    <script>$(document).ready(function(){$("#dataTable").DataTable()});</script>
  </body>
  </html>
