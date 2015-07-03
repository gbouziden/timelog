<?php
	session_start();
	include("config/db.php");
	include("config/timelog.php");
	include_once('config/worklog.php');

 
	if( strcmp(md5('1'), $_GET['usergroup']) == 0  && isset($_GET['startlogdate']) && isset($_GET['endlogdate']) && isset($_GET['userlog']) ) //non-checkin users
	{
		 $startdate = explode('-', $_GET['startlogdate']  );
		 $enddate = explode('-', $_GET['endlogdate']  );
		 $userlog = $_GET['userlog'];
		 
		$result ='';
		
		$query = "SELECT user_name as User, log_time AS \"Log No\", user_login AS \"Login Time\", user_logout AS \"Logout Time\", TIME_FORMAT(SEC_TO_TIME(log_time),'%Hhr %imin') AS \"Total Time\", DATE_FORMAT(log_date,'%M %d %Y') AS \"Log Date\" FROM tbl_logs WHERE user_name='".$userlog."' AND DATE(log_date) BETWEEN '".$startdate[2]."-".$startdate[1]."-".$startdate[0]."' AND '".$enddate[2]."-".$enddate[1]."-".$enddate[0]."'";
		//$dataresult = mysql_query($query); 
		
		query_to_csv($query, "export.csv", true);
		
/*			$header =  "User\tLog No\tLogin Time\tLogout Time\tTotal Time\tLog Date"; 
		
		while( $row = mysql_fetch_row( $dataresult ) )
		{
			$line = '';
			foreach( $row as $value )
			{                                            
				if ( ( !isset( $value ) ) || ( $value == "" ) )
				{
					$value = "\t";
				}
				else
				{
					$value = str_replace( '"' , '""' , $value );
					$value = '"' . $value . '"' . "\t";
				}
				$line .= $value;
			}
			$result .= trim( $line ) . "\n";
		}
		$result = str_replace( "\r" , "" , $result );
		 
		if ( $result == "" )
		{
			$result = "\nNo Record(s) Found!\n";                        
		}
		else
		{
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=export.csv");
			header("Pragma: no-cache");
			header("Expires: 0");
			print "$header\n$result";
		}
*/ 
	}
	
	function query_to_csv($query, $filename, $attachment = false, $headers = true) {
		
		if($attachment) {
			// send response headers to the browser
			header( 'Content-Type: text/csv' );
			header( 'Content-Disposition: attachment;filename='.$filename);
			$fp = fopen('php://output', 'w');
		} else {
			$fp = fopen($filename, 'w');
		}
		
		$result = mysql_query($query) or die( mysql_error() );
		
		if($headers) {
			// output header row (if at least one row exists)
			$row = mysql_fetch_assoc($result);
			if($row) {
				fputcsv($fp, array_keys($row));
				// reset pointer back to beginning
				mysql_data_seek($result, 0);
			}
		}
		
		while($row = mysql_fetch_assoc($result)) {
			fputcsv($fp, $row);
		}
		
		fclose($fp);
	}
	
?>
