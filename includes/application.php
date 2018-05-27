<?php
include 'database.php';
session_start();

//Recruiter Signup
if (isset($_POST['signup'])) {
  $cn = mysqli_real_escape_string($con, $_POST['cn']);
  $rn = mysqli_real_escape_string($con, $_POST['rn']);
  $dn = mysqli_real_escape_string($con, $_POST['dn']);
  $em = mysqli_real_escape_string($con, $_POST['em']);
  $ph = mysqli_real_escape_string($con, $_POST['ph']);
  $pw = mysqli_real_escape_string($con, $_POST['pw']);
  $cpw = mysqli_real_escape_string($con, $_POST['cpw']);
  $sql = "SELECT * FROM rec WHERE ema='$em'";
  $rs=mysqli_fetch_assoc(mysqli_query($con, $sql));
  if ($rs["ema"]==$em) {
            header("LOCATION: ../portal/register.php?usertaken");
            exit(); }
          else {
            $ins = "INSERT INTO rec (com, nam, des, ema, cno) VALUES ('$cn', '$rn', '$dn', '$em', '$ph')";
            $lin = "INSERT INTO login (un,pw,tp) VALUES ('$em','$pw','R')";
            mysqli_query($con, $ins);
            mysqli_query($con, $lin);
            header("LOCATION: ../home.php?signup=success");
            exit(); }
}

//Posting Jobs
elseif (isset($_POST['submit'])) {
  $po = mysqli_real_escape_string($con, $_POST['po']);
  $cp = mysqli_real_escape_string($con, $_POST['cp']);
  $xp = mysqli_real_escape_string($con, $_POST['x']);
  $xii = mysqli_real_escape_string($con, $_POST['xii']);
  $agg = mysqli_real_escape_string($con, $_POST['agg']);
  $arr = mysqli_real_escape_string($con, $_POST['arr']);
  $ld = mysqli_real_escape_string($con, $_POST['ld']);
  $rd = mysqli_real_escape_string($con, $_POST['rd']);
  $info = mysqli_real_escape_string($con, $_POST['info']);
  $cnt = mysqli_real_escape_string($con, $_POST['submit']);
  $deg = implode(', ', $_POST['degree']);
  $brh = implode(', ', $_POST['branch']);
$ins = "INSERT INTO jobs (pos, com, deg, brh, xp, xiip, agg, arr, ld, rd, info, con, status) VALUES ('$po','$cp','$deg','$brh','$xp','$xii','$agg','$arr','$ld','$rd','$info','$cnt','0')";
            mysqli_query($con, $ins);
            header("LOCATION: ../portal/recruiter.php?post=success");
            exit();
}

//Approving Applications
elseif (isset($_POST['approve']) || isset($_POST['rejapp'])) {
  if (isset($_POST['approve'])) {
    $jid = mysqli_real_escape_string($con, $_POST['approve']);
  } else {
    $jid = mysqli_real_escape_string($con, $_POST['rejapp']); }
  $approve = "UPDATE jobs SET status=1 WHERE jid=$jid";
  $update = mysqli_query($con, $approve);
  if (isset($_POST['approve'])) {
    header("LOCATION: ../portal/admin.php?approved"); }
  else {
    header("LOCATION: ../portal/admin.php?approved#rejected"); }
  exit();
}

//Rejecting Applications
elseif (isset($_POST['reject']) || isset($_POST['apprej'])) {
  if (isset($_POST['reject'])) {
    $jid = mysqli_real_escape_string($con, $_POST['reject']);
    $reject = "UPDATE jobs SET status=2, conf=0 WHERE jid=$jid";
    $update = mysqli_query($con, $reject);
    header("LOCATION: ../portal/admin.php?rejected");
  } else {
    $jid = mysqli_real_escape_string($con, $_POST['apprej']);
    $reject = "UPDATE jobs SET status=2, conf=0 WHERE jid=$jid";
    $update = mysqli_query($con, $reject);
    $change = "UPDATE applications SET res=0 WHERE jid=$jid";
    $resch = mysqli_query($con, $change);
    header("LOCATION: ../portal/admin.php?rejected#approved"); }
  exit();
}

//Confirming Recruitment
elseif (isset($_POST['conf'])) {
  $jid = mysqli_real_escape_string($con, $_POST['conf']);
  $confirm = "UPDATE jobs SET conf=1, rd='$date' WHERE jid=$jid";
  $update = mysqli_query($con, $confirm);
  header("LOCATION: ../portal/admin.php?confirmed#approved");
  exit();
}

//Registering Applications
elseif (isset($_POST['apply'])) {
  $jid = mysqli_real_escape_string($con, $_POST['apply']);
  $reg = mysqli_real_escape_string($con, $_POST['reg']);
  $apply = "INSERT INTO applications (reg, jid, res) VALUES ('$reg', $jid, 0)";
  $register = mysqli_query($con, $apply);
  header("LOCATION: ../portal/student.php?applied");
  exit();
}

//Updating Applications
elseif (isset($_POST['update'])) {
  $jid = mysqli_real_escape_string($con, $_POST['update']);
  $ld = mysqli_real_escape_string($con, $_POST['ld']);
  $rd = mysqli_real_escape_string($con, $_POST['rd']);
  $alter = "UPDATE jobs SET ld='$ld', rd='$rd' WHERE jid=$jid";
  $update = mysqli_query($con, $alter);
  header("LOCATION: ../portal/posted.php?updated");
  exit();
}

//Selecting Students
elseif (isset($_POST['select'])) {
  $reg = mysqli_real_escape_string($con, $_POST['select']);
  $jid = mysqli_real_escape_string($con, $_POST['jid']);
  $select = "UPDATE applications SET res=1 WHERE reg='$reg' AND jid=$jid";
  $update = mysqli_query($con, $select);
  $_SESSION['upres']=$jid;
  header("LOCATION: ../portal/upload.php?selected");
  exit();
}

//Rejecting Students
elseif (isset($_POST['notsel'])) {
  $reg = mysqli_real_escape_string($con, $_POST['notsel']);
  $jid = mysqli_real_escape_string($con, $_POST['jid']);
  $select = "UPDATE applications SET res=2 WHERE reg='$reg' AND jid=$jid";
  $update = mysqli_query($con, $select);
  $_SESSION['upres']=$jid;
  header("LOCATION: ../portal/upload.php?rejected");
  exit();
}

//Updating Student Account
elseif (isset($_POST['change'])) {
  $ph = mysqli_real_escape_string($con, $_POST['ph']);
  $em = mysqli_real_escape_string($con, $_POST['em']);
  $opw = mysqli_real_escape_string($con, $_POST['opw']);
  $npw = mysqli_real_escape_string($con, $_POST['npw']);
  $reg = mysqli_real_escape_string($con, $_POST['change']);
  $log = "SELECT pw FROM login WHERE un='$reg'";
  $dob = mysqli_fetch_assoc(mysqli_query($con, $log));
  if ($dob['pw']!=$opw) {
    header("LOCATION: ../portal/account.php?invalid");
    exit(); }

    $sdt = "SELECT * FROM stu WHERE reg='$reg'";
    $sde = mysqli_fetch_assoc(mysqli_query($con, $sdt));
  if ($sde['phone']===$ph && $sde['email']===$em && $npw==="") {
    header("LOCATION: ../portal/account.php?none");
    exit(); }

  elseif($sde['phone']!=$ph && $sde['email']===$em && $npw==="") {
    $stuc = "UPDATE stu SET phone='$ph' WHERE reg='$reg'";
    $excute = mysqli_query($con, $stuc);
    header("LOCATION: ../portal/account.php?phup");
    exit(); }

  elseif($sde['phone']===$ph && $sde['email']!=$em && $npw==="") {
    $stuc = "UPDATE stu SET email='$em' WHERE reg='$reg'";
    $excute = mysqli_query($con, $stuc);
    header("LOCATION: ../portal/account.php?emup");
    exit(); }

  elseif($sde['phone']===$ph && $sde['email']===$em && $npw!="") {
    $stuc = "UPDATE login SET pw='$npw' WHERE un='$reg'";
    $excute = mysqli_query($con, $stuc);
    header("LOCATION: ../portal/account.php?pwup");
    exit(); }

  elseif($sde['phone']!=$ph && $sde['email']!=$em && $npw!="") {
    $stuc = "UPDATE stu SET phone='$ph', email='$em' WHERE reg='$reg'";
    $excute = mysqli_query($con, $stuc);
    $stpw = "UPDATE login SET pw='$npw' WHERE un='$reg'";
    $pwc = mysqli_query($con, $stpw);
    header("LOCATION: ../portal/account.php?changed");
    exit(); }
}

//Updating Recruiter Account
elseif (isset($_POST['user'])) {
  $ph = mysqli_real_escape_string($con, $_POST['ph']);
  $opw = mysqli_real_escape_string($con, $_POST['opw']);
  $npw = mysqli_real_escape_string($con, $_POST['npw']);
  $reg = mysqli_real_escape_string($con, $_POST['user']);
  $log = "SELECT pw FROM login WHERE un='$reg'";
  $dob = mysqli_fetch_assoc(mysqli_query($con, $log));
  if ($dob['pw']!=$opw) {
    header("LOCATION: ../portal/user.php?invalid");
    exit(); }

    $sdt = "SELECT * FROM rec WHERE ema='$reg'";
    $sde = mysqli_fetch_assoc(mysqli_query($con, $sdt));
  if ($sde['cno']===$ph && $npw==="") {
    header("LOCATION: ../portal/user.php?none");
    exit(); }

  elseif($sde['cno']!=$ph && $npw==="") {
    $stuc = "UPDATE rec SET cno='$ph' WHERE ema='$reg'";
    $excute = mysqli_query($con, $stuc);
    header("LOCATION: ../portal/user.php?phup");
    exit(); }

  elseif($sde['cno']===$ph && $npw!="") {
    $stuc = "UPDATE login SET pw='$npw' WHERE un='$reg'";
    $excute = mysqli_query($con, $stuc);
    header("LOCATION: ../portal/user.php?pwup");
    exit(); }

  elseif($sde['phone']!=$ph && $npw!="") {
    $stuc = "UPDATE rec SET cno='$ph' WHERE ema='$reg'";
    $excute = mysqli_query($con, $stuc);
    $stpw = "UPDATE login SET pw='$npw' WHERE un='$reg'";
    $pwc = mysqli_query($con, $stpw);
    header("LOCATION: ../portal/user.php?changed");
    exit(); }
}

else {
  header("LOCATION: ../home.php");
  exit(); }
?>
