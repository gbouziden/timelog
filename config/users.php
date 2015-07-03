<?php

include_once("db.php");

 

class users
{

	private $user_id; 
	 
	public function setID($value)
	{
		$this->user_id = $value;
	} 
	
	private $user_name;
	public function setUserName($value)
	{
		$this->user_name = $value;
	}
	
	private $userpassword;
	public function setPassword($value)
	{
		$this->userpassword = $value;
	}
	
 
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

			$query 	= "INSERT INTO tbl_users( user_name, user_password) " .
			"  VALUES(  '" . $this->user_name ."', '" . $this->userpassword . "')";
			
			mysql_query($query); 
		}
		 
		mysql_close($conid);
	}
	
	
	public static function get_employee_count()
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

			$query 	= "SELECT COUNT(*) AS CNT FROM  tbl_users " ;
		 
			$result = mysql_query($query, $conid);
	 
			$row = mysql_fetch_array($result);
			
			$count = $row['CNT'];
			 
		}  
		
		return $count;
	
		}

	
	public static function get_checkin_users( $logdate)
	{
		global $server ;
		global $user ;
		global $password ;
		global $database ;
		
		$conid  = mysql_connect( $server , $user  , $password  );
		
		if($conid > 0 )
		{
			mysql_select_db($database  ,$conid);

			$query 	= "SELECT * FROM tbl_users INNER JOIN tbl_worklog " .
			" ON tbl_users.user_name=tbl_worklog.id WHERE DATE(logtime) = '" . $logdate . "' AND mode='CHECKIN'" ;
			
			$result = mysql_query($query, $conid); 
		} 
		return $result; 
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

			$query 	= "SELECT * FROM tbl_users INNER JOIN tbl_worklog " .
			" ON tbl_users.user_name=tbl_worklog.id WHERE DATE(logtime) = '" . $logdate . "'" ;
			
			$result = mysql_query($query, $conid); 
		} 
		return $result; 
	}
	
	 
	
     
}



?>
