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

              <?php
			  //echo basename($_SERVER['HTTP_REFERER']);
              if(basename($_SERVER['HTTP_REFERER'])=='login.php'){
				  $_SESSION['logout_page'] = 'login.php';
			  }elseif(basename($_SERVER['HTTP_REFERER'])=='ldap_login.php'){
				  $_SESSION['logout_page'] = 'ldap_login.php';
			  }elseif(basename($_SERVER['HTTP_REFERER'])=='ldap_login_banc.php'){
				  $_SESSION['logout_page'] = 'ldap_login_banc.php';
			  }elseif(basename($_SERVER['HTTP_REFERER'])=='ldap_login_cnbalva.php'){	
			  	  $_SESSION['logout_page'] = 'ldap_login_cnbalva.php';  
			  }
			  ?>

            </ul>
		<?php 	} ?>
		
	</div> 
	
	
</div>
</br>
</br>



	<div align = "center">
		<img src="image/smallpsd.jpg" width = "500" height = "120"/>	
	</div> 
 
