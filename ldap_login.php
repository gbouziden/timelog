<?php
session_start();
include("config/db.php");
$msg = '';

	global $server ;
	global $user ;
	global $password ;
	global $database ;
	
	// LDAP variables
	global $ldaphost;  
	global $ldapport;                  

  


if(isset($_REQUEST['hdn_submit']) && $_REQUEST['hdn_submit']=="1"){
	
	$msg = "";
	   
	$ldapconn = ldap_connect("ip.address",port)or die("Could not connect to LDAP server.");   
	 
	///$ldapconn = ldap_connect($ldaphost, $ldapport) or die("Could not connect to $ldaphost"); 
	//$dn="uid=" . $_REQUEST['user_name']. ",ou=system";
	$ldaprdn = $_REQUEST['username'];
	$ldappass =  $_REQUEST['user_password'];
	
	//ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
 
	if ($ldapconn) 
	{
		// binding to ldap server
		//$ldapbind = ldap_bind($ldapconn, $dn, $ldappass); 
		$ldapbind = ldap_bind($ldapconn,$ldaprdn,$ldappass);
		// verify binding
		if ($ldapbind) 
		{
			//login successfull 
			$_SESSION['checkin'] = date('d/m/Y h:i:s A');
			$_SESSION['user_name'] = $_REQUEST['user_name'];
			
			//send email
			$to ="yours@host.com";
			$from = "timeloggerfsystem@timelogger.com"; // sender
			$subject = "User Check-In Log";
			$message = "<h1>Employee check-in details</h1>";
			$message .= "<p><strong>User Account:</strong>" . $_REQUEST['user_name'] . "</p>";
			$message .= "<p><strong>Check-In Time:</strong>" .  date('d/m/Y h:i:s A') . "</p>"; 
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'To: Admin <admin@timelogger.com>' . "\r\n";
			$headers .= "From: " . $from  . "\r\n" .
			"Reply-To: " . $from . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
			// send mail
			mail( $to ,$subject,$message, $headers);
			header('Location: index.php');
				
				
		} 
		else 
		{
			//login failed 
			$msg = "Invalid username and password.";
			
		}
	}
	 
 
}

?>
 <?php  include_once('template/header.php'); ?>
 
 
<div class="row page-area">

  <div class="panel panel-primary" style="width:300px; margin:100px auto;">
    <div class="panel-heading">User Login</div>
    <div class="panel-body">
      <form class="form-signin" method="post" action="">
      
          <?php if($msg!=''){ ?>
          <p class="bg-primary"><?php echo $msg; ?></p>
          <?php } ?>
      
          <input name="user_name" type="text" class="form-control" placeholder="User Name" required autofocus><br/>
          <input type="password" name="user_password" class="form-control" placeholder="User Password" required><br/>
          <button class="btn btn-lg btn-primary btn-block" type="submit">
              Sign In
          </button>
          <input type="hidden" name="hdn_submit" value="1">
      </form>
    </div>
  </div>


</div>

 <?php  include_once('template/footer.php'); ?>
