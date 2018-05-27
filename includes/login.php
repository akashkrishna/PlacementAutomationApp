<?php
if (isset($_POST['login'])) {
  include 'database.php';
  session_start();
  $un=mysqli_real_escape_string($con, $_POST['un']);
  $pw=mysqli_real_escape_string($con, $_POST['pw']);
    $sql = "SELECT * FROM login WHERE un='$un'";
    $result = mysqli_query($con, $sql);
    $resultcheck = mysqli_num_rows($result);
    $rs=mysqli_fetch_assoc(mysqli_query($con, $sql));
        if ($resultcheck < 1){
          header("LOCATION: ../home.php?login=nreg");
      exit();
    }else {
          if ($rs["pw"] != $pw) {
          header("LOCATION: ../home.php?login=pwde");
          exit();
        }
      else {
            if ($rs["tp"]=="R") {
              $rec="SELECT * FROM rec WHERE ema='$un'";
              $rc=mysqli_fetch_assoc(mysqli_query($con, $rec));
              $_SESSION['id'] =$rc['nam'];
              $_SESSION['eid'] =$rc['ema'];
              $_SESSION['logrec']=true;
              header("LOCATION: ../portal/recruiter.php");
              exit();
      }
      elseif ($rs["tp"]=="S") {
        $stu="SELECT * FROM stu WHERE reg='$un'";
        $sc=mysqli_fetch_assoc(mysqli_query($con, $stu));
        $_SESSION['id']=$sc['nam'];
        $_SESSION['reg']=$sc['reg'];
        $_SESSION['logstu']=true;
        header("LOCATION: ../portal/student.php");
        exit();
      }
      else {
        $_SESSION['admin']=true;
        header("LOCATION: ../portal/admin.php");
        exit(); }
    }
  }
}
      else {
    header("LOCATION: ../home.php?login=error");
    exit(); }
