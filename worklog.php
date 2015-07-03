<?php
session_start();
include("config/db.php");

if($_SESSION['user_name']==''){

  header('Location: login.php');

}

$user_name = $_SESSION['user_name'];

if($_REQUEST['logtime']!=''){
	
	$_SESSION['logtime'] = $_SESSION['logtime'] + 1;
	
	if($_SESSION['checkin_time']==''){
		$_SESSION['checkin_time'] = date("g:i a");
	}
	
	$selQry = "SELECT *FROM tbl_logs WHERE user_name='$user_name' AND log_date=CURDATE()";
	$resLog = mysql_query($selQry);
	
	if(mysql_num_rows($resLog)>0){
		
	
	}else{
		
	  $insQry = "INSERT INTO tbl_logs(ID, user_name, user_login, user_logout, log_date) VALUES(null, '$user_name', NOW(), '00:00:00', CURDATE())";
	  mysql_query($insQry);
	  
	}
	
	echo $_SESSION['checkin_time'];
	
	die();
	
}

if($_REQUEST['checkout']=="checkout"){
	
	$updQry = "UPDATE tbl_logs SET user_logout=NOW(), log_time=".$_SESSION['logtime']." WHERE user_logout='00:00:00' AND log_date=CURDATE() AND user_name='$user_name'";
	mysql_query($updQry);
	
	// Unset all of the session variables.
	$_SESSION = array();
	
	// If it's desired to kill the session, also delete the session cookie.
	// Note: This will destroy the session, and not just the session data!
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}
	
	// Finally, destroy the session.
	session_destroy();
	die();
	
}
?>
<?php include('template/header_work_log_page.php'); ?>


<div class="col-lg-6 col-lg-offset-3" id='timesheetarea'>
  <div class="panel panel-primary">
    <!-- Default panel contents -->
    <div class="panel-heading"><span class="glyphicon glyphicon-time"></span> My Time Sheet</div>
    <div class="panel-body">
      <?php
       
  
          echo "<div class='alert alert-danger'><h4>Current Week days</h4>";
          echo "<div class='text-center'><ul class='pagination'>"; 
          $startday=1;
          $weekbeginning='';
       
          $datevalue =   ( date('d') -  date('N') ) + 1  ; 
          $weekbeginning = date('Y') . "-" . date('m')  ."-" . $datevalue ;
          
           
          $date = $weekbeginning ;
          
          for($day= 1; $day <= 7; $day++)
          {
              echo "<li><a href='#'  onclick=\"loadtimesheetfordate('" .   date( 'Y-m-d' ,  strtotime ($date)  ) . "')\">" .  
              date( 'D' ,  strtotime ($date)  ) . "<br/>" . date( 'd' ,  strtotime ($date)  )  . "</a></li>"; 
              
              $tdate = strtotime ( '1 day' , strtotime ( $date ) ) ;
              $date = date('Y', $tdate) . "-" .date('m', $tdate) . "-" .date('d', $tdate);
              
          } 
       
       echo "</ul>";
      
      echo "<div class='week-navigation'>";
        
      
      $date =  $weekbeginning ; 
      $tdate = strtotime ( '-7 day' , strtotime ( $date ) ) ;
      $date = date('Y', $tdate) . "-" .date('m', $tdate) . "-" .date('d', $tdate);
               
  
       echo '<ul class="pager"><li class="previous"><a href="#" onclick="previousweek(\'' .  date( 'Y-m-d' ,  strtotime ($date)  )  .'\')">&larr; Preview Week</a></li>';
       
      $date =  $weekbeginning ; 
      $tdate = strtotime ( '7 day' , strtotime ( $date ) ) ;
      $date = date('Y', $tdate) . "-" .date('m', $tdate) . "-" .date('d', $tdate);
      
       echo '<li class="next"><a href="#" onclick="nextweek(\'' . date( 'Y-m-d' ,  strtotime ($date)  )   .'\')">Next Week &rarr;</a></li></ul>'; 
       echo "</div>";
       echo "</div>";
       
       echo '</div>';
        
       
      ?>
       
  
    </div>
    
    <div class='grid'></div>
    
    
    </div>
  </div>
</div>  

<?php include('template/footer.php'); ?>
