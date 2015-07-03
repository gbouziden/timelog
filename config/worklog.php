<?php
include_once("db.php");

class worklog
{

	private $logno; 
	
	private $id;
	public function setID($value)
	{
		$this->id = $value;
	} 
	
	private $timespan;
	public function setTimespan($value)
	{
		$this->timespan = $value;
	}
	
	private $mode;
	public function setMode($value)
	{
		$this->mode = $value;
	}
	
	private $logtime; 
    public function saveworklog()
	{	
		global $server ;
		global $user ;
		global $password ;
		global $database ;
		
		$conid  = mysql_connect( $server , $user  , $password  );
		
		if($conid > 0 )
		{
			mysql_select_db($database  ,$conid);

			$query 	= "INSERT INTO tbl_worklog( id, timespan, mode, logtime) " .
			"  VALUES(  '" . $this->id ."', '" . $this->timespan . "' , " .
			"'" . $this->mode ."',  NOW())";
			
			mysql_query($query); 
		}
		 
		mysql_close($conid);
	}
	
	
	public static function getworklog($id, $logdate)
	{	
		global $server ;
		global $user ;
		global $password ;
		global $database ;
		
		$conid  = mysql_connect( $server , $user  , $password  );
		
		if($conid > 0 )
		{
			mysql_select_db($database  ,$conid);

			//$query 	= "SELECT * FROM  tbl_worklog WHERE  id ='" .  $id ."' AND DATE(logtime) = '" .  $logdate."' AND mode IN ('CHECKIN','CHECKOUT')" ;
			$query = "SELECT * FROM  tbl_logs WHERE user_name ='".$id."' AND DATE(log_date)='".$logdate."'" ;
			
			$result = mysql_query($query, $conid); 
		} 
		return $result; 
	}
	
	public static function get_checkin_users( $startlogdate, $endlogdate, $user_log)
	{
		global $server ;
		global $user ;
		global $password ;
		global $database ;
		
		$conid  = mysql_connect( $server , $user  , $password  );
		
		if($conid > 0 )
		{
			mysql_select_db($database, $conid);

			$query = "SELECT *FROM tbl_logs WHERE tbl_logs.user_name='".$user_log."' AND DATE(log_date) BETWEEN '".$startlogdate."' AND '".$endlogdate."'" ;
			
			$result = mysql_query($query, $conid); 
		} 
		return $result; 
	}
	
	public static function get_checkin_users_count( $logdate)
	{
		global $server ;
		global $user ;
		global $password ;
		global $database ;
		
		$conid  = mysql_connect( $server , $user  , $password  );
		$count =0;
		if($conid > 0 )
		{
			mysql_select_db($database  ,$conid); 
			$query 	= "SELECT COUNT(*) AS CNT FROM tbl_users INNER JOIN tbl_logs " .
			" ON tbl_users.user_name=tbl_logs.user_name WHERE DATE(tbl_logs.log_date) = '" . $logdate . "'" ;
		 
			$result = mysql_query($query, $conid); 
			$row = mysql_fetch_array($result);
			
			$count = $row['CNT'];
			
			mysql_close($conid);
		} 
		return $count; 
	}
	
	public static function get_non_checkin_users_count($logdate)
	{
		global $server ;
		global $user ;
		global $password ;
		global $database ;
		
		$conid  = mysql_connect( $server , $user  , $password  );
		$count =0;
		if($conid > 0 )
		{
			mysql_select_db($database  ,$conid); 
			$query 	= " SELECT COUNT(*) AS CNT FROM tbl_users ".
			" WHERE user_name NOT IN (SELECT user_name FROM tbl_logs WHERE DATE(log_date) = '" . $logdate . "' ) " ;
		 
			$result = mysql_query($query, $conid); 
			$row = mysql_fetch_array($result); 
			$count = $row['CNT'];
			
			mysql_close($conid);
		} 
		return $count; 
	}
	
	public static function get_non_checkin_users( $logdate)
	{	
		global $server ;
		global $user ;
		global $password ;
		global $database ;
		
		$conid  = mysql_connect( $server , $user  , $password  );
		
		if($conid > 0 )
		{
			mysql_select_db($database  ,$conid);

			$query 	= " SELECT * FROM tbl_users ".
			" WHERE user_name NOT IN (SELECT user_name FROM tbl_logs WHERE DATE(log_date) = '" . $logdate . "' ) " ;
			
			$result = mysql_query($query, $conid); 
		} 
		return $result; 
	}
	
	
	
	
	public static function get_all_user_status( $logdate)
	{
	   
	   global $server ;
		global $user ;
		global $password ;
		global $database ;
		
		$conid  = mysql_connect( $server , $user  , $password  );
		
		if($conid > 0 )
		{
			mysql_select_db($database  ,$conid);

			$query 	= "SELECT *  FROM tbl_users LEFT JOIN " .
			" ( SELECT *  FROM  tbl_logs WHERE   DATE(log_date) = '" . $logdate . "' ) as worklog " .
			" ON tbl_users.user_name= worklog.user_name "; 
			
			$result = mysql_query($query, $conid); 
		} 
		return $result;  

	}
	
	
	public static function get_checkin_users_with_column($col_string, $logdate)
	{
		global $server ;
		global $user ;
		global $password ;
		global $database ;
		
		$conid  = mysql_connect( $server , $user  , $password  );
		
		if($conid > 0 )
		{
			mysql_select_db($database  ,$conid);

			$query = "SELECT ".$col_string." FROM tbl_logs WHERE DATE(log_date) = '" . $logdate . "'" ;
			 
			
			$result = mysql_query($query, $conid); 
		} 
		return $result; 
	}
	
	
	public static function get_user_work_duration($startlogdate, $endlogdate)
	{
	   
	    global $server ;
		global $user ;
		global $password ;
		global $database ;
		
		$conid  = mysql_connect( $server , $user  , $password  );
		
		if($conid > 0 )
		{
			mysql_select_db($database  ,$conid);

/*			$query 	= "SELECT *  FROM tbl_users LEFT JOIN " .
			" ( SELECT user_name, SUM(log_time) as hwork FROM  tbl_logs where MONTH(log_date)='" .  $month ."' and YEAR(log_date) ='" . $year ."' AND user_logout!='00:00:00' ) as worklog " .
			" ON tbl_users.user_name= worklog.user_name "; 
*/			//$query 	= "SELECT user_name, log_time as hwork FROM tbl_logs where MONTH(log_date)='" .  $month ."' and YEAR(log_date) ='" . $year ."' AND user_logout!='00:00:00'"; 

			$query = "SELECT user_name, sum(log_time) as hwork, log_date FROM tbl_logs WHERE DATE(log_date) BETWEEN '".$startlogdate."' AND '".$endlogdate."' GROUP BY user_name" ;

			 
			$result = mysql_query($query, $conid); 
		} 
		return $result; 
	   

	}
	
	


	
     
}



?>
