<?php
$con = mysqli_connect('localhost', 'root', '', 'pas');
date_default_timezone_set('Asia/Kolkata');
$date=date('Y-m-d');
$fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
