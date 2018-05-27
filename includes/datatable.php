<?php
include '../includes/database.php';
session_start();
if (!$_SESSION['admin']) {
    header("LOCATION: ../includes/logout.php");
    exit();
  }
else{
switch ($_GET['type']) {

  //Awaiting List
  case 'awaiting':
  $sql = "SELECT * FROM jobs WHERE status='0'";
  $res = mysqli_query($con, $sql);
  echo "<div class=card-header>
    <i class=\"fa fa-table\"></i> Awaiting Applications</div>
  <div class=card-body>
    <div class=table-responsive>
  <table class=table id=awaiting width=100% cellspacing=0>
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
    <tbody>";
  while ($row = mysqli_fetch_assoc($res)) {
   $cmp="SELECT * FROM rec WHERE ema='".$row['con']."'";
   $com=mysqli_fetch_assoc(mysqli_query($con, $cmp));
          echo " <tr>
                 <td> $com[com] </td>
                 <td> $row[pos] </td>
                 <td> $row[com] </td>
                 <td> $row[ld] </td>
                 <td> $row[rd] </td>
                 <td>
                   <form action=details method=post>
                     <button class=\"btn btn-secondary\" type=submit name=info value=$row[jid]><i class=\"fa fa-info-circle\"></i>
                     </button></form></td></tr>"; }
                     echo "</tbody></table></div></div>
               <div class=\"card-footer small text-muted\">Last Updated: "; echo date('l d/m/Y h:i:s A');
               echo "</div> <script>$(\"#awaiting\").DataTable();</script>";
    break;

  //Approved List
  case 'approved':
  $sql = "SELECT * FROM jobs WHERE status='1' AND conf='0'";
  $res = mysqli_query($con, $sql);
  echo "<div class=card-header>
    <i class=\"fa fa-table\"></i> Approved Applications</div>
  <div class=card-body>
    <div class=table-responsive>
  <table class=table id=approved width=100% cellspacing=0>
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
    <tbody>";
  while ($row = mysqli_fetch_assoc($res)) {
   $cmp="SELECT * FROM rec WHERE ema='".$row['con']."'";
   $com=mysqli_fetch_assoc(mysqli_query($con, $cmp));
          echo " <tr>
                 <td> $com[com] </td>
                 <td> $row[pos] </td>
                 <td> $row[com] </td>
                 <td> $row[ld] </td>
                 <td> $row[rd] </td>
                 <td>
                   <form action=details method=post>
                     <button class=\"btn btn-secondary\" type=submit name=approved value=$row[jid]><i class=\"fa fa-info-circle\"></i>
                     </button></form></td></tr>"; }
                     echo "</tbody></table></div></div>
               <div class=\"card-footer small text-muted\">Last Updated: "; echo date('l d/m/Y h:i:s A');
               echo "</div> <script>$(\"#approved\").DataTable();</script>";
    break;

    //Confrimed List
    case 'confirmed':
    $sql = "SELECT * FROM jobs WHERE status='1' AND conf='1'";
    $res = mysqli_query($con, $sql);
    echo "<div class=card-header>
      <i class=\"fa fa-table\"></i> Confirmed Applications</div>
    <div class=card-body>
      <div class=table-responsive>
    <table class=table id=confirmed width=100% cellspacing=0>
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
      <tbody>";
    while ($row = mysqli_fetch_assoc($res)) {
     $cmp="SELECT * FROM rec WHERE ema='".$row['con']."'";
     $com=mysqli_fetch_assoc(mysqli_query($con, $cmp));
            echo " <tr>
                   <td> $com[com] </td>
                   <td> $row[pos] </td>
                   <td> $row[com] </td>
                   <td> $row[ld] </td>
                   <td> $row[rd] </td>
                   <td>
                     <form action=details method=post>
                       <button class=\"btn btn-secondary\" type=submit name=confirmed value=$row[jid]><i class=\"fa fa-info-circle\"></i>
                       </button></form></td></tr>"; }
                       echo "</tbody></table></div></div>
                 <div class=\"card-footer small text-muted\">Last Updated: "; echo date('l d/m/Y h:i:s A');
                 echo "</div> <script>$(\"#confirmed\").DataTable();</script>";
      break;

    //Rejected List
    case 'rejected':
    $sql = "SELECT * FROM jobs WHERE status='2'";
    $res = mysqli_query($con, $sql);
    echo "<div class=card-header>
      <i class=\"fa fa-table\"></i> Rejected Applications</div>
    <div class=card-body>
      <div class=table-responsive>
    <table class=table id=rejected width=100% cellspacing=0>
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
      <tbody>";
    while ($row = mysqli_fetch_assoc($res)) {
     $cmp="SELECT * FROM rec WHERE ema='".$row['con']."'";
     $com=mysqli_fetch_assoc(mysqli_query($con, $cmp));
            echo " <tr>
                   <td> $com[com] </td>
                   <td> $row[pos] </td>
                   <td> $row[com] </td>
                   <td> $row[ld] </td>
                   <td> $row[rd] </td>
                   <td>
                     <form action=details method=post>
                       <button class=\"btn btn-secondary\" type=submit name=rejected value=$row[jid]><i class=\"fa fa-info-circle\"></i>
                       </button></form></td></tr>"; }
                       echo "</tbody></table></div></div>
                 <div class=\"card-footer small text-muted\">Last Updated: "; echo date('l d/m/Y h:i:s A');
                 echo "</div> <script>$(\"#rejected\").DataTable();</script>";
      break;

      //Placed List
      case 'placed':
      $sql = "SELECT * FROM applications WHERE res='1'";
      $res = mysqli_query($con, $sql);
      echo "<div class=card-header>
        <i class=\"fa fa-table\"></i> Placement Reports</div>
      <div class=card-body>
        <div class=table-responsive>
      <table class=table id=placed width=100% cellspacing=0>
        <thead>
          <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Degree</th>
          <th>Branch</th>
          <th>Placed In</th>
          <th>Recruited On</th>
          <th>Contact</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Degree</th>
          <th>Branch</th>
          <th>Placed In</th>
          <th>Recruited On</th>
          <th>Contact</th>
          </tr>
        </tfoot>
        <tbody>";
      while ($row = mysqli_fetch_assoc($res)) {
        $std="SELECT * FROM stu WHERE reg='".$row['reg']."'";
        $stu=mysqli_fetch_assoc(mysqli_query($con, $std));
        $job="SELECT con,rd FROM jobs WHERE jid=$row[jid]";
        $cnt=mysqli_fetch_assoc(mysqli_query($con, $job));
        $cmp="SELECT com FROM rec WHERE ema='".$cnt['con']."'";
        $com=mysqli_fetch_assoc(mysqli_query($con, $cmp));
              echo " <tr>
                     <td> $stu[reg] </td>
                     <td> $stu[nam] </td>
                     <td> $stu[deg] </td>
                     <td> $stu[dep] </td>
                     <td> $com[com] </td>
                     <td> $cnt[rd] </td>
                     <td> $stu[phone] </td>
                     </tr>"; }
                         echo "</tbody></table></div></div>
                   <div class=\"card-footer small text-muted\">Last Updated: "; echo date('l d/m/Y h:i:s A');
                   echo "</div> <script>$(\"#placed\").DataTable();</script>";
        break;

        //Recruitment Reports
        case 'report':
        $sql = "SELECT * FROM jobs WHERE status='1'";
        $res = mysqli_query($con, $sql);
        echo "<div class=card-header>
          <i class=\"fa fa-table\"></i> Recruitment Reports</div>
        <div class=card-body>
          <div class=table-responsive>
        <table class=table id=report width=100% cellspacing=0>
          <thead>
            <tr>
            <th>Company</th>
            <th>Position</th>
            <th>Compensation</th>
            <th>Students Applied</th>
            <th>Students Selected</th>
            <th>Details</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
          <th>Company</th>
          <th>Position</th>
          <th>Compensation</th>
          <th>Students Applied</th>
          <th>Students Selected</th>
          <th>Details</th>
            </tr>
          </tfoot>
          <tbody>";
        while ($row = mysqli_fetch_assoc($res)) {
          $cmp="SELECT com FROM rec WHERE ema='".$row['con']."'";
          $com=mysqli_fetch_assoc(mysqli_query($con, $cmp));
          $apl = "SELECT COUNT(*) FROM applications WHERE jid='".$row['jid']."'";
          $cnt=mysqli_fetch_assoc(mysqli_query($con, $apl));
          $slt = "SELECT COUNT(*) FROM applications WHERE res=1 AND jid='".$row['jid']."'";
          $slc=mysqli_fetch_assoc(mysqli_query($con, $slt));
                echo " <tr>
                       <td> $com[com] </td>
                       <td> $row[pos] </td>
                       <td> $row[com] </td>
                       <td>"; echo implode('', $cnt); echo "</td>
                       <td>"; echo implode('', $slc); echo "</td>
                       <td>
                         <form action=details method=post>
                           <button class=\"btn btn-secondary\" type=submit name=report value=$row[jid]><i class=\"fa fa-info-circle\"></i>
                           </button></form></td></tr>"; }
                           echo "</tbody></table></div></div>
                     <div class=\"card-footer small text-muted\">Last Updated: "; echo date('l d/m/Y h:i:s A');
                     echo "</div> <script>$(\"#report\").DataTable();</script>";
          break;
} } ?>
