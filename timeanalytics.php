
<?php
	session_start();
	include("config/db.php");
	include("config/timelog.php");


	if(!isset($_SESSION['user_name'])){

	  header('Location: login.php');

	}

	$user_name = $_SESSION['user_name'];

	if( isset($_REQUEST['btncheckin']) && $_REQUEST['btncheckin']!='')
	{

		$checkinlog = new timelog();
		$checkinlog->setUsername( $user_name ); 
		echo $checkinlog->checkin();
		 
		
	}

if( isset($_REQUEST['checkout']) && $_REQUEST['checkout']=="checkout"){
	
	$updQry = "UPDATE tbl_logs SET user_logout=NOW(), log_time=".$_SESSION['logtime']." WHERE user_logout='00:00:00' AND log_date=CURDATE() AND user_name='$user_name'";
	mysql_query($updQry);
	
	$_SESSION = array(); 
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}
	 
	session_destroy();
	die();
	
}
?>

 <?php  include_once('template/header.php'); ?>
 <div class="row page-area">
 
 <div class="col-lg-2 col-lg-offset-1"> 
  <div class="panel panel-primary" id="timer"  >
  <div class="panel-heading">
    <h3 class="panel-title">
	<span  class="glyphicon glyphicon glyphicon-cog" data-toggle="modal" data-target=".bs-example-modal-lg"></span> Admin Controls</h3>
  </div>
  <div class="panel-body">
		<p class="text-center">
		<ul class='nav nav-pills nav-stacked'>
			<li><a   href="index.php">Home</a></li>
			<li><a   href="timeanalytics.php?usergroup=<?php echo md5('1'); ?>">Checked-In Users</a></li>
			
			<li><a   href="timeanalytics.php?usergroup=<?php echo md5('2'); ?>">Work History</a></li>
			
			<li><a   href="timeanalytics.php?usergroup=<?php echo md5('3'); ?>">Not Checked-In Users</a></li>
			
			<li><a   href="timeanalytics.php?usergroup=<?php echo md5('4'); ?>">Monthly Report</a></li>
			
			 <li><hr/></li>
			 <li><hr/></li>
			 <li><hr/></li>
			 <li><hr/></li><br/><li><hr/></li>
			<li><a   href="logout.php">Sign-Out</a></li>
		
		</p>
   </div>
</div>
    
 </div>
  <div class="col-lg-7">
  
		<div class="panel panel-primary" id="timer"  >
		  <div class="panel-heading">
			<h3 class="panel-title">
			<span  class="  glyphicon glyphicon-stats" data-toggle="modal" data-target=".bs-example-modal-lg"></span> 
			
			<?php
			if( isset($_GET['usergroup'] ) && $_GET['usergroup'] == md5('1'))
			{
			   echo "Checked-In Users";
			 }
			 if( isset($_GET['usergroup'] ) && $_GET['usergroup'] == md5('2'))
			{
			   echo "Work History";
			 }
			 if( isset($_GET['usergroup'] ) && $_GET['usergroup'] == md5('3'))
			{
			   echo "Not Checked-In Users";
			 }
			 
			if( isset($_GET['usergroup'] ) && $_GET['usergroup'] == md5('4'))
			{
			   echo "Monthly Work Report";
			 }
			?>
			  
			
			</h3>
		  </div>
		  <div class="panel-body">
		  
		  <form class="form-inline" role="form" action="" method="get" style="margin-bottom:20px; display:block; overflow:hidden;">
		  
			  <div class="form-group col-lg-12">
			  
				<?php
				
				if( isset($_GET['usergroup'] ) && $_GET['usergroup'] == md5('4'))
			{
			?>
<!--            <label class="col-lg-2 control-label">Date:</label>
			<select name="month" class="form-control  col-lg-3" >
				<option value='1'>January</option>
				<option value='2'>February</option>
				<option value='3'>May</option>
				<option value='4'>April</option>
				<option value='5'>May</option>
				<option value='6'>June</option>
				<option value='7'>July</option>
				<option value='8'>August</option>
				<option value='9'>September</option>
				<option value='10'>October</option>
				<option value='11'>November</option>
				<option value='12'>December</option>
				</select>
				
				<input class="form-control col-lg-2 " type="text"  name="year" value="<?php echo date('Y'); ?>"/>  
				<input class="btn btn-info col-lg-2 " type="submit"  value="Show"/>
-->                
            	 <label class="col-lg-2 control-label">Start Date:</label>
				 <input class="col-lg-2 form-control" type="text" name ="startlogdate" id="startlogdate" value="<?php echo ($_GET['startlogdate']=="")?date('d-m-Y'):$_GET['startlogdate']; ?>"  />
                 <label class="col-lg-2 control-label">End Date:</label>
                 <input class="col-lg-2 form-control" type="text" name ="endlogdate" id="endlogdate" value="<?php echo ($_GET['endlogdate']=="")?date('d-m-Y'):$_GET['endlogdate']; ?>"  /><br /> <br />
				 <input class="btn btn-info col-lg-2" type="submit" value="Show" style="margin:10px 0 0 20px;" />
			
			<?php
			}elseif( isset($_GET['usergroup'] ) && $_GET['usergroup'] == md5('1')){
			?>	
            	 <label class="col-lg-2 control-label">Start Date:</label>
				 <input class="col-lg-2 form-control" type="text" name ="startlogdate" id="startlogdate" value="<?php echo ($_GET['startlogdate']=="")?date('d-m-Y'):$_GET['startlogdate']; ?>"  />
                 <label class="col-lg-2 control-label">End Date:</label>
                 <input class="col-lg-2 form-control" type="text" name ="endlogdate" id="endlogdate" value="<?php echo ($_GET['endlogdate']=="")?date('d-m-Y'):$_GET['endlogdate']; ?>"  /><br /> <br />
                 <label class="col-lg-2 control-label">User:</label>
                 <input class="col-lg-2 form-control" type="text" name ="user" id="user" value="<?php echo $_GET['user']; ?>" /> 
				 <input class="btn btn-info col-lg-2" type="submit" value="Show" style="margin:0 0 0 20px;" />
            
			<?php }else{ ?>
            	 <label class="col-lg-2 control-label">Date:</label>
				 <input class="col-lg-2 form-control" type="text" name ="logdate" id="logdate" value="<?php echo ($_GET['logdate']=="")?date('d-m-Y'):$_GET['logdate']; ?>"  />
				 <input class="btn btn-info col-lg-2" type="submit" value="Show" style="margin:0 0 0 20px;" />
			 <?php } ?> 
			  <input type="hidden" value="<?php echo $_GET['usergroup'];?>" name="usergroup" />
			  </div>
		  </form>
		  <div style="margin-bottom:20px"></div>
		  <?php
		  
		  //checkin users
		  if( strcmp(md5('1'), $_GET['usergroup']) == 0 && isset($_GET['startlogdate']) && isset($_GET['endlogdate']) && isset($_GET['user']) ) //non-checkin users
		  {
			 $startdate = explode('-', $_GET['startlogdate']  );
			 $enddate = explode('-', $_GET['endlogdate']  );
			 $userlog = $_GET['user'];
		     include_once('config/worklog.php');
			 $result = worklog::get_checkin_users( $startdate[2]."-".$startdate[1]."-".$startdate[0], $enddate[2]."-".$enddate[1]."-".$enddate[0], $userlog);
			 
			 $i=0;
			 $table  = "";
			 while($row = mysql_fetch_array($result) )
			 {
			    $table .= "<tr>";
				$table .= "<td>" . ($i+1) . "</td>";
				$table .= "<td>" . $row['user_name'] . "</td>";
				$table .= "<td>" .  $row['user_login']  . "</td>";
				$table .= "<td>" .  $row['user_logout']  . "</td>";
				if( isset(  $row['log_time'] ) &&   $row['log_time']  != "")
				{
					$table .= "<td><span >" ;
					$table .=  intval($row['log_time']/3600 ) . " hr " ;
					$min = intval($row['log_time']%3600);
					
					$table .=  intval( $min /60 ) . " min " ;					
					
					$sec = intval($min  % 60 );
					
					$table .=  $sec  . " sec </span></td>"; 
				}
				else
				{
					$table .= "<td><span >0 sec</span></td>"; 
				}				
				/*$table .= "<td>" .  $row['log_time']  . "</td>";*/
				$table .= "</tr>";
				$i++;
		 
			 }
			 
			 if($i > 0)
			 {
			   echo "<table class='table table-bordered'>" .
			    "<tr><th>Sl. No.</th><th>User Name</th><th>Check-in Time</th><th>Check-out Time</th><th>Total Duration</th></tr>" . $table .
				"<tr><td colspan='5'><a class='btn btn-info' target='_blank' href='dataexporter.php?startlogdate="  . $_GET['startlogdate'] . "&endlogdate="  . $_GET['endlogdate'] . "&userlog="  . $_GET['user'] . "&usergroup=" . $_GET['usergroup'] .  "' >Export to CSV</a></td></tr>" .
				"</table>" ;
			 }
			  
		  }
		  
		  //work report
		  
		   if(strcmp(md5('2'), $_GET['usergroup']) == 0 && isset($_GET['logdate'])) //non-checkin users
		  {
			$date = explode('-', $_GET['logdate']  );
			
		     include_once('config/worklog.php');
			 $result = worklog::get_all_user_status( $date[2] ."-". $date[1] ."-" . $date[0]);
			 
			 $i=0;
			 $table  = "";
			 while($row = mysql_fetch_array($result) )
			 {
			   $table  .= "<tr>";
				$table .= "<td>" . ($i +1) . "</td>";
				$table .= "<td>" . $row['user_name'] . "</td>";
				if( $row['user_login']!="00:00:00" &&  $row['user_logout']!="00:00:00")
				{
					$table .= "<td>" . $row['user_login'] . "</td>";
					$table .= "<td>" . $row['user_logout'] . "</td>"; 
				}
				else
				{
					$table .= "<td>-</td>";
					$table .= "<td><span style='color:red'>NO CHECK-IN</span></td>"; 
				}
				$table .= "</tr>";
				$i++;
			 }
			 
			 if($i > 0)
			 {
			   echo "<table class='table table-bordered'>" .
			    "<tr><th>Sl. No.</th><th>User Name</th><th>Check-in Time</th><th>Check-out Time</th></tr>" . $table .  "</table>";
			 }
			  
		  }
		  
		   
		  
		  if(strcmp(md5('3'), $_GET['usergroup']) == 0 && isset($_GET['logdate'])) //non-checkin users
		  {
			$date = explode('-', $_GET['logdate']  );
			
		     include_once('config/worklog.php');
			 $result = worklog::get_non_checkin_users( $date[2] ."-". $date[1] ."-" . $date[0]);
			 
			 $i=0;
			 $table  = "";
			 while($row = mysql_fetch_array($result) )
			 {
			    $table  .= "<tr>";
				$table .= "<td>" . ($i +1) . "</td>";
				$table .= "<td>" . $row['user_name'] . "</td>"; 
				$table .= "<td> No Check-In</td>"; 
				$table .= "</tr>";
				$i++;
			 }
			 
			 if($i > 0)
			 {
			   echo "<table class='table table-bordered'>" .
			    "<tr><th>Sl. No.</th><th>User Name</th><th>Status</th></tr>" . $table .  "</table>";
			 }
			  
		  }
		  
		  
		  
		   if(strcmp(md5('4'), $_GET['usergroup']) == 0 && isset($_GET['startlogdate']) && isset($_GET['endlogdate']) ) //non-checkin users
		  {
			  
			 $startdate = explode('-', $_GET['startlogdate']  );
			 $enddate = explode('-', $_GET['endlogdate']  );
			 //$userlog = $_GET['user'];
			 
		     include_once('config/worklog.php');
			 //$result = worklog::get_user_work_duration( $_GET['month'] , $_GET['year'] );
			 $result = worklog::get_user_work_duration( $startdate[2]."-".$startdate[1]."-".$startdate[0], $enddate[2]."-".$enddate[1]."-".$enddate[0]);
			 
			 $i=0;
			 $table  = "";
			 while($row = mysql_fetch_array($result) )
			 {
			   $table  .= "<tr>";
				$table .= "<td>" . ($i +1) . "</td>";
				$table .= "<td>" . $row['log_date'] . "</td>";
				$table .= "<td>" . $row['user_name'] . "</td>";
				if( isset(  $row['hwork'] ) &&   $row['hwork']  != "")
				{
					$table .= "<td><span >" ;
					$table .=  intval($row['hwork']/3600 ) . " hr " ;
					$min = intval($row['hwork']%3600);
					
					$table .=  intval( $min /60 ) . " min " ;					
					
					$sec = intval($min  % 60 );
					
					$table .=  $sec  . " sec </span></td>"; 
				}
				else
				{
					$table .= "<td><span >0 sec</span></td>"; 
				}
				$table .= "</tr>";
				$i++;
			 }
			 
			 if($i > 0)
			 {
			   echo "<table class='table table-bordered'>" .
			    "<tr><th>Sl. No.</th><th>Log Date</th><th>User Name</th><th>Work Duration</th> </tr>" . $table .  "</table>";
			 }
			  
		  }
		  
		  
		  
		  
		  ?>
		  
		  
	</div>
	</div>
  
  </div>
 

 
</div>
   
	
	<?php  include_once('template/footer.php'); ?>
