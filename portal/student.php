<?php
  include '../includes/database.php';
  session_start();
  if (!$_SESSION['logstu']) {
    header("LOCATION: ../includes/logout.php");
    exit();
  }
  $std = "SELECT * FROM stu WHERE reg=\"$_SESSION[reg]\"";
  $stu = mysqli_fetch_assoc(mysqli_query($con, $std));
  $sql = "SELECT * FROM jobs WHERE status='1' AND ld>='$date' AND xp<=\"$stu[x]\" AND xiip<=\"$stu[xii]\" AND agg<=\"$stu[agg]\" AND arr=\"$stu[arr]\"";
  $res = mysqli_query($con, $sql);
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
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Student Dashboard</title>
  <link href="../assets/css/bootstrap4.min.css" rel="stylesheet">
  <link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/css/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="../assets/css/sb-admin.min.css" rel="stylesheet">
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/bootstrapAlert.js"></script>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php if (strpos($fullurl, "applied") == true) {
    echo "<script>$(document).ready(function(){BootstrapAlert.success({title: \"You're Registered!\", message: \"You will be notified with the recruitment details soon\"});});</script>"; }
    ?>
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="../home.php">Placement Cell</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Recruitments">
          <a class="nav-link" href="student.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Recruitments</span>
          </a></li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Results">
          <a class="nav-link" href="results.php">
            <i class="fa fa-fw fa-list-alt"></i>
            <span class="nav-link-text">Results</span>
          </a></li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Account">
          <a class="nav-link" href="account.php">
            <i class="fa fa-fw fa-user-circle"></i>
            <span class="nav-link-text">Account</span>
          </a></li></ul>

      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Sign Out</a>
        </li>
      </ul>
    </div>
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
          <i class="fa fa-table"></i> Job Applications</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Company</th>
                  <th>Position</th>
                  <th>Compensation</th>
                  <th>Apply By</th>
                  <th>Recruitment Date</th>
                  <th>Details</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Company</th>
                  <th>Position</th>
                  <th>Compensation</th>
                  <th>Apply By</th>
                  <th>Recruitment Date</th>
                  <th>Details</th>
                </tr>
              </tfoot>
              <tbody>
                <?php while ($row = mysqli_fetch_assoc($res)) {
                    $job = "SELECT * FROM applications WHERE reg=\"$_SESSION[reg]\" AND jid=$row[jid]";
                    $jrs = mysqli_query($con, $job);
                    $placed = "SELECT * FROM applications WHERE reg=\"$_SESSION[reg]\" AND res=1";
                    $limit = mysqli_query($con, $placed);
                  if (mysqli_num_rows($jrs)<1 && mysqli_num_rows($limit)<2 && in_array($stu['deg'],explode(', ', $row['deg'])) && in_array($stu['dep'],explode(', ', $row['brh']))) {
                  $cmp="SELECT * FROM rec WHERE ema='".$row['con']."'";
                  $com=mysqli_fetch_assoc(mysqli_query($con, $cmp));
                  ?>
                  <tr>
                  <td> <?php echo $com['com']; ?></td>
                  <td><?php echo $row['pos']; ?></td>
                  <td><?php echo $row['com']; ?></td>
                  <td><?php echo $row['ld']; ?></td>
                  <td><?php echo $row['rd']; ?></td>
                  <td>
                    <form action="details.php" method="post">
                      <input type="text" name="reg" value="<?php echo $_SESSION['reg']; ?>" hidden>
                      <button class="btn btn-secondary" type="submit" name="details" value="<?php echo $row['jid']; ?>"><i class="fa fa-info-circle"></i>
                      </button></form>
                  </td></tr>
                <?php }} ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Last Updated: <?php echo date('l d/m/Y h:i:s A'); ?></div>
      </div>
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
            </button>
          </div>
          <div class="modal-body">Are you sure you want to end your current session?</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit" name="logout">Logout</button>
          </div>
        </div>
      </div>
    </div></form>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery.easing.min.js"></script>
    <script src="../assets/js/jquery.dataTables.js"></script>
    <script src="../assets/js/dataTables.bootstrap4.js"></script>
    <script src="../assets/js/sb-admin.min.js"></script>
    <script>$(document).ready(function(){$("#dataTable").DataTable()});</script>
  </div>
  </body>
  </html>
