<?php

include_once("db.php");

class timelog
{

	private $username;
	public function setUsername($value)
	{
		$this->username = $value;
	}
	
	
	private $logintime;
	public function setLogintime($value)
	{
		$this->logintime = $value;
	} 
	
	private $logoutime;
	public function setLogouttime($value)
	{
		$this->logoutime = $value;
	}
	
	private $logdate;
	public function setLogdate($value)
	{
		$this->logdate = $value;
	}
	
	
    public function checkin()
	{	
		
		global $server ;
		global $user ;
		global $password ;
		global $database ;

 
		$conid  = mysql_connect( $server , $user  , $password  );
		
		if($conid > 0 )
		{
			mysql_select_db($database  ,$conid);

			$query 	= "INSERT INTO tbl_logs( user_name, user_login, user_logout, log_date) " .
			"  VALUES(  '" . $this->username ."', NOW(), '00:00:00', CURDATE())";
			
			mysql_query($query); 
		}
		
		mysql_close($conid);
	}
	
     
}



?>
