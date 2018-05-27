<!DOCTYPE html>
<html lang="en" oncontextmenu="return false">
<head>
  <noscript>
    <style>html{display:none;}</style>
    <meta http-equiv="refresh" content="0; url=../includes/js.html">
  </noscript>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Recruiter Registration</title>
  <link href="../assets/css/bootstrap4.min.css" rel="stylesheet">
  <link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/css/sb-admin.min.css" rel="stylesheet">
  <link href="../assets/css/sweetalert.min.css" rel="stylesheet" type="text/css">
  <script src="../assets/js/sweetalert.min.js"></script>
</head>

<body class="bg-dark" onload="document.reg.cn.focus()">
  <?php $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
          if (strpos($fullurl, "usertaken") == true) {
            echo "<script>swal(\"User Already Registered!\", \"Please try logging in with the same ID\", \"error\")</script>"; } ?>

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Create a new Account
      <a href="../home.php" class="fa fa-home" style="float:right; font-size:25px" title="Go back to login"></a></div>
      <div class="card-body">
        <form name="reg" action="../includes/application.php" method="post" onsubmit="return verify()">
          <div class="form-group">
            <label for="cn">Company name</label>
                <input class="form-control" name="cn" type="text" placeholder="Enter company name" required title="Enter valid company name">
                </div>

              <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                <label for="rn">Recruiter name</label>
                <input class="form-control" name="rn" type="text" placeholder="Enter your name" required pattern="[A-Z a-z]+" title="Enter valid Name">
                </div>
                <div class="col-md-6">
                <label for="rn">Designation</label>
                <input class="form-control" name="dn" type="text" placeholder="Enter your designation" required pattern="[A-Z a-z]+" title="Enter valid Designation">
              </div></div></div>

              <div class="form-group">
                <label for="em">Email address (username)</label>
                  <input class="form-control" name="em" type="email" placeholder="Enter email address" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Enter valid Mail ID">
                    </div>

            <div class="form-group"><label for="ph">Contact Number</label>
            <input class="form-control" name="ph" type="number" placeholder="Enter contact number" required min="1" minlength="10" title="Enter valid phone number">
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="pw">Password</label>
                <input class="form-control" name="pw" type="password" placeholder="Create new Password" required minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                </div>
              <div class="col-md-6">
                <label for="cpw">Confirm password</label>
                <input class="form-control" name="cpw" type="password" placeholder="Confirm entered password" required minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                </div></div></div>

                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <input type="reset" class="btn btn-secondary btn-block" value="Reset" title="Clear all entered values"></div>
          <div class="col-md-6">
            <button type="submit" class="btn btn-primary btn-block" name="signup" title="Create the account">Signup</button>
          </div></div></div></form></div></div></div>

        <script type="text/javascript">
          function verify() {
              if (reg.pw.value!=reg.cpw.value) {
                  document.reg.cpw.value="";
                  document.reg.pw.value="";
                  document.reg.pw.focus();
                  swal("Password Mismatch!", "Please verify and reenter the passwords...", "error");
                  return false; }}
        </script>
    </body>
</html>
