<?php
include '../includes/database.php';
session_start();
if (!$_SESSION['logrec']) {
    header("LOCATION: ../includes/logout.php");
    exit();
    }
    $sql = "SELECT * FROM jobs WHERE con=\"$_SESSION[eid]\" AND status=1";
    $res = mysqli_query($con, $sql);
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
  <link href="../assets/css/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="../assets/css/sb-admin.min.css" rel="stylesheet">
  <link href="../assets/css/sweetalert.min.css" rel="stylesheet" type="text/css">
  <script src="../assets/js/sweetalert.min.js"></script>
  </head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">

  <?php if (strpos($fullurl, "updated") == true) {
    echo "<script>swal(\"Application Updated!\", \"The students will be notified...\", \"success\")</script>";
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
          <a class="nav-link" href="recruiter.php" target="_self" title="Post job">
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

    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i> Posted Recruitments</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Position</th>
                <th>Apply By</th>
                <th>Recruitment Date</th>
                <th>Students Applied</th>
                <th>Students Selected</th>
                <th>Details</th>
                <th>Results</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Position</th>
                <th>Apply By</th>
                <th>Recruitment Date</th>
                <th>Students Applied</th>
                <th>Students Selected</th>
                <th>Details</th>
                <th>Results</th>
              </tr>
            </tfoot>
            <tbody>
              <?php while ($row = mysqli_fetch_assoc($res)) {
                $apl = "SELECT COUNT(*) FROM applications WHERE jid='".$row['jid']."'";
                $cnt = mysqli_fetch_assoc(mysqli_query($con, $apl));
                $slt = "SELECT COUNT(*) FROM applications WHERE res=1 AND jid='".$row['jid']."'";
                $slc = mysqli_fetch_assoc(mysqli_query($con, $slt)); ?>
                <tr>
                <td><?php echo $row['pos']; ?></td>
                <td><?php echo $row['ld']; ?></td>
                <td> <?php echo $row['rd']; ?></td>
                <td><?php echo implode('', $cnt); ?></td>
                <td><?php echo implode('', $slc); ?></td>
                <td> <form action="details.php" method="post">
                    <button class="btn btn-secondary" type="submit" name="posted" value="<?php echo $row['jid']; ?>" title="View/Update Recruitment Details"><i class="fa fa-info-circle"></i>
                    </button></form></td>
                <td> <form action="upload.php" method="post">
                      <?php if ($row['conf']==='1'): ?>
                        <button class="btn btn-primary" type="submit" name="upload" value="<?php echo $row['jid']; ?>" title="Post recruitment results"><i class="fa fa-upload"></i>
                          <?php else: ?>
                            <button disabled class="btn btn-secondary" type="button" title="Recruitment not yet confirmed"><i class="fa fa-upload"></i>
                      <?php endif; ?>
                    </button></form></td></tr>
              <?php } ?>
            </tbody></table></div></div>
      <div class="card-footer small text-muted">Last Updated: <?php echo date('l d/m/Y h:i:s A'); ?></div></div>

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
            <button class="btn btn-secondary" type="button" data-dismiss="modal" title="Close Window">Cancel</button>
            <button class="btn btn-primary" type="submit" name="logout" title="Sign Out">Logout</button>
          </div></div></div></div></form></div></div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery.easing.min.js"></script>
    <script src="../assets/js/jquery.dataTables.js"></script>
    <script src="../assets/js/dataTables.bootstrap4.js"></script>
    <script src="../assets/js/sb-admin.min.js"></script>
    <script>$(document).ready(function(){$("#dataTable").DataTable()});</script>
  </body>
  </html>
