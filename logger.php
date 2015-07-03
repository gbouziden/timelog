<?php
session_start();

include_once("config/worklog.php");

if( isset($_POST['log']) && $_POST['log'] == true)
{

	 
	$worklog = new worklog();
	$worklog->setID($_POST['id']);
	$worklog->setMode($_POST['mode']);
	$worklog->setTimespan($_POST['timespan']);  
	$worklog->saveworklog();  
	 
}
 
  

if( isset($_POST['getlog']) )
{ 
	//retrieve work log 
	$result = worklog::getworklog($_POST['id'], date('Y/m/d'));
	$output = "";
	echo "<table class='table table-striped'>" .
	"<tr><th colspan='4'> Timesheet for: " . date('Y/m/d')    . "</th></tr>";
	
	echo "<tr><td>Log #</td><td>Timespan</td><td>Check In</td> <td>Check Out</td> </tr>";
	
	$i=0; $j=1;
	
	while($row = mysql_fetch_array($result))
	{
	  $output .= "<tr>";
	  $output .="<td>".$j."</td>";
	  $output .="<td>".gmdate("H\h i\m s\s", $row['log_time'])."</td>";
	  $output .= "<td>".$row['user_login']."</td>";
	  $output .= "<td>".$row['user_logout']."</td>"; 
	  $output .= "</tr>";  
	  
	  $i++;
	}
	
	if($i > 0)
	{
	  echo $output ; 
	}
	else
	{
		echo "<tr><td colspan='4'><strong>No work log found!</strong></td></tr>";
	}
	echo "</table>"; 
	
}

if( isset($_POST['logdate']) )
{

//retrieve work log 
	
	$result = worklog::getworklog($_POST['id'], $_POST['logdate'] ); 
	
	echo "<table class='table table-striped'>" .
	"<tr><th colspan='4'> Timesheet for: " . $_POST['logdate']    . "</th></tr>";
	
	echo "<tr><td>Log #</td><td>Timespan</td><td>Check In</td> <td>Check Out</td> </tr>";
	
	$j=1;
	
	while($row = mysql_fetch_array($result))
	{
	  echo "<tr>";
	  echo "<td>".$j."</td>";
	  echo "<td>".gmdate("H\h i\m s\s", $row['log_time'])."</td>";
	  echo "<td>".$row['user_login']."</td>";
	  echo "<td>".$row['user_logout']."</td>"; 
	  echo "</tr>";
	  
	  $j++;  
	}
	echo "</table>";  
	
}
	
	
?>
