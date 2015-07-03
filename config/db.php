<?php
$server = "localhost";
$user = "root";
$password = "admin";
$database = "timedb";
  
$link = mysql_connect($server, $user, $password) or die('Could not connect: ' . mysql_error());
mysql_select_db($database, $link);
?>
