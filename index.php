<?php
session_start();
include("config/db.php");
include("config/users.php");
include("config/worklog.php");

if($_SESSION['user_name']==''){

  header('Location: login.php');

}

$user_name = $_SESSION['user_name'];

if($_REQUEST['logtime']!=''){
	
	$_SESSION['logtime'] = $_SESSION['logtime'] + 1;
	
	if($_SESSION['checkin_time']==''){
		$_SESSION['checkin_time'] = date("g:i a");
	}
	
	$selQry = "SELECT *FROM tbl_logs WHERE user_name='$user_name' AND log_date=CURDATE() AND log_time=0";
	$resLog = mysql_query($selQry);
	
	if(mysql_num_rows($resLog)>0){
		
	
	}else{
		
	  $insQry = "INSERT INTO tbl_logs(ID, user_name, user_login, user_logout, log_time, log_date) VALUES(null, '$user_name', NOW(), '00:00:00', '0', CURDATE())";
	  mysql_query($insQry);
	  
	}
	
	echo "You are check-in at ".$_SESSION['checkin_time']." | You have been working for <span class='label label-danger' id='timer'>".gmdate("H\h i\m s\s", $_SESSION['logtime'])."</span>";
	
	die();
	
}

if($_REQUEST['checkout']=="checkout"){
	
	$updQry = "UPDATE tbl_logs SET user_logout=NOW(), log_time=".$_SESSION['logtime']." WHERE user_logout='00:00:00' AND log_date=CURDATE() AND user_name='$user_name'";
	mysql_query($updQry);
	
	$_SESSION['logtime'] = '';
	
	// Unset all of the session variables.
	//$_SESSION = array();
	
	// If it's desired to kill the session, also delete the session cookie.
	// Note: This will destroy the session, and not just the session data!
/*	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}
*/	
	// Finally, destroy the session.
	//session_destroy();
	die();
	
}
?>
<?php include('template/header.php'); ?>

<?php  if(isset($_SESSION['user_name']) && strcmp( $_SESSION['user_name'], "admin" ) == 0 ) {  ?>
<div class="panel panel-primary" id="timer">
  <div class="panel-heading">
    <h3 class="panel-title"><span  class="glyphicon glyphicon glyphicon-cog" data-toggle="modal" data-target=".bs-example-modal-lg"></span> Admin Controls</h3>
  </div>
  <div class="panel-body">
    <p class="text-center">
      <a class="btn btn-info" href="timeanalytics.php?usergroup=<?php echo md5('1'); ?>">Show Users</a>
      <a class="btn btn-info" href="timeanalytics.php?usergroup=<?php echo md5('2'); ?>">Work History</a>
      <a class="btn btn-info" href="timeanalytics.php?usergroup=<?php echo md5('3'); ?>">Non-Checkin Users</a>
      <a class="btn btn-info" href="logout.php">Sign Out</a>
    </p>
  </div>
</div>

<!-- brief summary -->
<div class="panel panel-primary" id="timer">
  <div class="panel-heading">
    <h3 class="panel-title">
	<span  class="glyphicon glyphicon glyphicon-user" data-toggle="modal" data-target=".bs-example-modal-lg"></span> User Status</h3>
  </div>
  <div class="panel-body">
    <ul class="list-group">
    <li class="list-group-item">Total registered employees: <a href='' class='badge '><?php echo users::get_employee_count(); ?></a></li>
    <li class="list-group-item">Employee who have checked-in today: <a href='timeanalytics.php?logdate=<?php echo date('d-m-Y') ;?>&usergroup=<?php echo md5(1); ?>' class='badge'><?php echo worklog::get_checkin_users_count(date('Y-m-d')); ?></a></li>
    <li class="list-group-item">Employee who have not checked-in today: <a href='timeanalytics.php?logdate=<?php echo date('d-m-Y') ;?>&usergroup=<?php echo md5(3); ?>' class='badge'><?php echo worklog::get_non_checkin_users_count(date('Y-m-d')); ?></a></li>
    </ul>
  </div>
</div>
  
<?php } else { ?>

<div class="panel panel-primary" id="timer-block" style="width:600px; margin:100px auto;">
  <div class="panel-heading">
    <h3 class="panel-title"><span  class="glyphicon glyphicon-calendar" data-toggle="modal" data-target=".bs-example-modal-lg"></span> Time Logger</h3>
  </div>
  <div class="panel-body">
      <input type='hidden' class='form-control timer' placeholder='<?php echo $_SESSION['logtime']; ?>' value="<?php echo $_SESSION['logtime']; ?>" />
       <p class='alert alert-info'><span id="check-in-time">You checked-in at <?php if(isset($_SESSION['checkin_time'])) echo $_SESSION['checkin_time']; else echo date("g:i a"); ?> | You have been working for <span class='label label-danger' id='timer'><?php if($_SESSION['logtime']!=""){ echo gmdate("H\h i\m s\s", $_SESSION['logtime']); }else{ echo '00h 00m 00s'; } ?></span></span></p>
      
      <button class='btn btn-success start-timer-btn'>Check In</button>
      <button class='btn btn-success resume-timer-btn hidden'>Resume</button>
      <button class='btn pause-timer-btn hidden'>Pause</button>
      <button class='btn btn-danger remove-timer-btn hidden'>Check Out</button>
  </div>
</div>

<?php } ?>

<?php include('template/footer.php'); ?>
