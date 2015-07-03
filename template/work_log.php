<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Logger</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">

</head>
<body>

<div class="container-fluid">
<div class="row header">
	<div class="col-lg-4 col-lg-offset-2">
		<img src="image/logo.png" alt="Logo"/>	
	</div> 
	
	<div class="col-lg-4 col-lg-offset-2">
		
		 <?php  if(isset($_SESSION['user_name']) && strcmp( $_SESSION['user_name'], "admin" ) != 0 ) {  ?>
			<ul  class="nav nav-pills">
			<li><a href='login.php'>Check-In</a></li>
				<li><a href="#" onclick='loadtimesheet();'>View Work Log</a></li>  
				<li><a href="logout.php" >Sign-out</a></li>  
				</ul>
			<?php 	} ?>
			
		
	</div> 
	
	
</div>
 
