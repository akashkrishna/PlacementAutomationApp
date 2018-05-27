<?php
include '../includes/database.php';
session_start();
if (isset($_POST['info']) || isset($_POST['approved']) || isset($_POST['rejected']) || isset($_POST['report']) || isset($_POST['details']) || isset($_POST['results']) || isset($_POST['posted'])
      || isset($_SESSION['ud']) || isset($_POST['confirmed'])) {
      if (isset($_POST['info'])) {
        $jid = mysqli_real_escape_string($con, $_POST['info']);}
      elseif (isset($_POST['approved'])) {
        $jid = mysqli_real_escape_string($con, $_POST['approved']);}
        elseif (isset($_POST['confirmed'])) {
        $jid = mysqli_real_escape_string($con, $_POST['confirmed']);}
        elseif (isset($_POST['rejected'])) {
          $jid = mysqli_real_escape_string($con, $_POST['rejected']);}
          elseif (isset($_POST['report'])) {
            $jid = mysqli_real_escape_string($con, $_POST['report']);}
            elseif (isset($_POST['details'])) {
              $reg = mysqli_real_escape_string($con, $_POST['reg']);
              $jid = mysqli_real_escape_string($con, $_POST['details']);}
              elseif (isset($_POST['results'])) {
                $jid = mysqli_real_escape_string($con, $_POST['results']);}
                elseif (isset($_POST['posted'])) {
                  $jid = mysqli_real_escape_string($con, $_POST['posted']);}
                  elseif (isset($_SESSION['ud'])) {
                    $jid = mysqli_real_escape_string($con, $_SESSION['ud']);}

    $sql = "SELECT * FROM jobs WHERE jid='$jid'";
    $res = mysqli_fetch_assoc(mysqli_query($con, $sql));
    $rec = "SELECT * FROM rec WHERE ema='$res[con]'";
    $rslt = mysqli_fetch_assoc(mysqli_query($con, $rec));
    } else {
    header("LOCATION: ../home.php");
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
  <?php if (isset($_POST['info']) || isset($_POST['approved']) || isset($_POST['rejected']) || isset($_POST['report']) || isset($_POST['confirmed'])): ?>
    <title>Administrator Portal</title>
<?php elseif (isset($_POST['details']) || isset($_POST['results'])): ?>
    <title>Student Dashboard</title>
  <?php elseif (isset($_POST['posted'])): ?>
      <title>Recruiter Dashboard</title>
  <?php endif; ?>
  <link href="../assets/css/bootstrap4.min.css" rel="stylesheet">
  <link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/css/sb-admin.min.css" rel="stylesheet">
  <link href="../assets/css/sweetalert.min.css" rel="stylesheet" type="text/css">
  <script src="../assets/js/sweetalert.min.js"></script>
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
        <?php if (isset($_POST['info']) || isset($_POST['approved']) || isset($_POST['rejected']) || isset($_POST['report']) || isset($_POST['confirmed'])): ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Applications">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Applications</span></a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li><a href="admin.php#awaiting">Awaiting</a></li>
            <li><a href="admin.php#approved">Approved</a></li>
            <li><a href="admin.php#confirmed">Confirmed</a></li>
            <li><a href="admin.php#rejected">Rejected</a></li>
          </ul></li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reports">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
              <i class="fa fa-fw fa-area-chart"></i>
              <span class="nav-link-text">Reports</span></a>
            <ul class="sidenav-second-level collapse" id="collapseMulti">
              <li><a href="admin.php#placed">Placement</a></li>
              <li><a href="admin.php#report">Recruitment</a></li>
          </li></ul>
          <?php elseif(isset($_POST['details']) || isset($_POST['results'])): ?>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Recruitments">
              <a class="nav-link" href="../home.php">
                <i class="fa fa-fw fa-dashboard"></i>
                <span class="nav-link-text">Recruitments</span>
              </a></li>
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Results">
                <a class="nav-link" href="results.php">
                  <i class="fa fa-fw fa-check-circle"></i>
                  <span class="nav-link-text">Results</span>
                </a></li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Account">
                  <a class="nav-link" href="account.php">
                    <i class="fa fa-fw fa-user-circle"></i>
                    <span class="nav-link-text">Account</span>
                  </a></li>
          <?php elseif (isset($_POST['posted'])): ?>
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
          <?php endif; ?></ul>

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
        <li class="breadcrumb-item">
          <?php if (isset($_POST['info'])): ?>
            <a href="admin.php#awaiting">Awaiting Applications</a>
          <?php elseif (isset($_POST['approved'])): ?>
            <a href="admin.php#approved">Approved Applications</a>
          <?php elseif (isset($_POST['confirmed'])): ?>
            <a href="admin.php#confirmed">Confirmed Applications</a>
            <?php elseif (isset($_POST['rejected'])): ?>
              <a href="admin.php#rejected">Rejected Applications</a>
              <?php elseif (isset($_POST['report'])): ?>
                  <a href="admin.php#report">Recruitment Reports</a>
                  <?php elseif (isset($_POST['details'])): ?>
                      <a href="student.php">Recruitments</a>
                      <?php elseif(isset($_POST['results'])): ?>
                          <a href="results.php">Registered Jobs</a>
                          <?php elseif(isset($_POST['posted'])): ?>
                              <a href="posted.php">Posted Applications</a>
          <?php endif; ?></li>
        <li class="breadcrumb-item active"><?php echo $rslt['com'];?> Job Details</li>
      </ol>

  <div class="container" id="main">
    <form action="../includes/application.php" method="post" name="details" onsubmit="return verify()">
      <?php if (isset($_POST['info']) || isset($_POST['approved']) || isset($_POST['rejected']) || isset($_POST['report']) || isset($_POST['confirmed'])): ?>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <h6>Recruiter</h6>
                    <p class="form-control"><?php echo $rslt['nam'];?></p>
                  </div>
                  <div class="col-md-6">
                    <h6>Designation</h6>
                  <p class="form-control"><?php echo $rslt['des'];?></p>
                  </div></div></div>

                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <h6>E-Mail</h6>
                        <p class="form-control"><?php echo $res['con'];?></p>
                      </div>
                      <div class="col-md-6">
                        <h6>Phone</h6>
                        <p class="form-control"><?php echo $rslt['cno'];?></p>
                      </div></div></div><hr>
                    <?php endif; ?>

                      <div class="form-group">
                        <div class="form-row">
                          <div class="col-md-6">
                            <h6>Position Offered</h6>
                            <p class="form-control"><?php echo $res['pos'];?></p>
                          </div>
                          <div class="col-md-6">
                            <h6>Compensation Offered</h6>
                            <p class="form-control"><?php echo $res['com'];?> INR P.A</p>
                          </div></div></div>

                          <div class="form-group">
                            <div class="form-row">
                              <div class="col-md-6">
                                <h6>Degree</h6>
                                <p class="form-control"><?php echo $res['deg'];?></p>
                              </div>
                              <div class="col-md-6">
                                <h6>Branch</h6>
                                <p class="form-control"><?php echo $res['brh'];?></p>
                              </div></div></div>

                              <div class="form-group">
                                <div class="form-row">
                                  <div class="col-md-6">
                                    <h6>10th</h6>
                                    <p class="form-control"><?php echo $res['xp'];?>%</p>
                                  </div>
                                  <div class="col-md-6">
                                    <h6>12th</h6>
                                    <p class="form-control"><?php echo $res['xiip'];?>%</p>
                                  </div></div></div>

                                  <div class="form-group">
                                    <div class="form-row">
                                      <div class="col-md-6">
                                        <h6>Aggregate</h6>
                                        <p class="form-control"><?php echo $res['agg'];?>%</p>
                                      </div>
                                      <div class="col-md-6">
                                        <h6>Arrear</h6><p class="form-control">
                                        <?php if($res['arr']=='1'){echo "Allowed";}
                                              else {echo "Not Allowed";}?></p>
                                      </div></div></div>

                                      <div class="form-group">
                                        <?php if ($res['info']!="") {
                                          echo "<h6>Additional Information</h6>";
                                           echo "<p class=form-control>";
                                           echo $res['info'];echo"</p>";}
                                              ?>
                                      </div>

                                      <div class="form-group">
                                        <div class="form-row">
                                          <div class="col-md-6">
                                            <h6>Apply By</h6>
                                            <?php if (isset($_POST['posted']) && $res['ld']<$date):?>
                                              <input class="form-control" name="ld" type="date" min="<?php echo $date; ?>" max="<?php echo date('Y');?>-12-31" title="Enter valid apply by date">
                                            <?php else: ?>
                                              <p class="form-control"><?php echo $res['ld'];?></p>
                                            <?php endif ?>
                                          </div>
                                          <div class="col-md-6">
                                            <h6>Recruitment Date</h6>
                                            <?php if (isset($_POST['posted']) && $res['rd']<$date):?>
                                            <input class="form-control" name="rd" type="date" min="<?php echo $date; ?>" max="<?php echo date('Y');?>-12-31" title="Enter preferred date of recruitment">
                                            <?php else: ?>
                                            <p class="form-control"><?php echo $res['rd'];?></p>
                                            <?php endif ?>
                                          </div></div></div>

                                      <div class="form-group">
                                        <div class="form-row">
                                          <?php if (isset($_POST['info'])): ?>
                                              <div class="col-md-6">
                                                <button type="submit" class="btn btn-secondary btn-block" name="reject" value="<?php echo $jid;?>">Reject</button></div>
                                              <?php elseif (isset($_POST['approved'])): ?>
                                                  <div class="col-md-6">
                                                    <button type="submit" class="btn btn-secondary btn-block" name="apprej" value="<?php echo $jid;?>">Reject</button></div>
                                                    <div class="col-md-6">
                                                      <button type="submit" class="btn btn-primary btn-block" name="conf" value="<?php echo $jid;?>">Confirm</button></div>
                                                  <?php endif; ?>
                                          <?php if (isset($_POST['info']) && $res['ld']>=$date && $res['ld']>=$date): ?>
                                        <div class="col-md-6">
                                          <button type="submit" class="btn btn-primary btn-block" name="approve" value="<?php echo $jid;?>">Approve</button></div>
                                        <?php elseif (isset($_POST['rejected']) && $res['ld']>=$date && $res['ld']>=$date): ?>
                                          <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-block" name="rejapp" value="<?php echo $jid;?>">Approve</button></div>
                                        <?php elseif (isset($_POST['info']) && $res['ld']<$date): ?>
                                          <div class="col-md-6">
                                          <input type="button" class="btn btn-primary btn-block" value="Approve" onclick="cant()"></div>
                                        <?php elseif (isset($_POST['rejected']) && $res['ld']<$date): ?>
                                          <div class="col-md-12">
                                          <input type="button" class="btn btn-primary btn-block" value="Approve" onclick="cant()"></div>
                                        <?php elseif (isset($_POST['details'])): ?>
                                          <input type="text" hidden name="reg" value="<?php echo $reg;?>">
                                          <button type="submit" class="btn btn-primary btn-block" name="apply" value="<?php echo $jid;?>">Register</button>
                                        <?php elseif (isset($_POST['posted'])): ?>
                                          <?php if ($res['ld']<$date || $res['rd']<$date): ?>
                                            <button type="submit" class="btn btn-primary btn-block" name="update" value="<?php echo $jid;?>">Update</button>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                        </div></div></form></div>

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
          </div></div></div></div></div></div>

          <script type="text/javascript">
            function cant() {
              swal("Can't Approve!", "The application date expired.\n Contact the recruiter for an update of the date...", "error"); }

              function verify(){
                 if (document.details.rd.value<=document.details.ld.value) {
                swal("Invalid Date!", "Recruitment Date must be after the Registration date", "error");
                  return false; }}
          </script>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery.easing.min.js"></script>
    <script src="../assets/js/sb-admin.min.js"></script>
  </body>
  </html>
