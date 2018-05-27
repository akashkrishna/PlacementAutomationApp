<?php
if (isset($_POST['logout'])) {
  session_start();
  session_unset();
  session_destroy();
  header("LOCATION: ../home.php");
  exit();
}
else {
session_start();
session_unset();
session_destroy();
header("LOCATION: ../home.php?login=error");
exit();
  }
?>
