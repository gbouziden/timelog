<?php

if(isset($_POST['date']))
{
	 
	  
	$tdate =   strtotime ( $_POST['date']) ;
	$date = date('Y', $tdate) . "-" .date('m', $tdate) . "-" .date('d', $tdate);
	 
	for($day= 1; $day <= 7; $day++)
	{
		echo "<li><a href='#'  onclick=\"loadtimesheetfordate('" .   date( 'Y-m-d' ,  strtotime ($date)  ) . "')\">" . 
		 date( 'D' ,  strtotime ($date)  ) . "<br/>" .  date( 'd' ,  strtotime ($date)  ) . "</a></li>"; 
		
		$tdate = strtotime ( '1 day' , strtotime ( $date ) ) ;
		$date = date('Y', $tdate) . "-" .date('m', $tdate) . "-" .date('d', $tdate);
			 
		
	} 	
}
	 
	 
	 
if(isset($_POST['pdate']) && isset($_POST['datenavi']))
{
	$tdate =   strtotime ( $_POST['pdate']) ;
	$date = date('Y', $tdate) . "-" .date('m', $tdate) . "-" .date('d', $tdate);
	$tdate = strtotime ( '-7 day' , strtotime ( $date ) ) ;
	$date = date('Y', $tdate) . "-" .date('m', $tdate) . "-" .date('d', $tdate);
	 
	  
	echo "<div class='week-navigation'>"; 
	echo '<ul class="pager"><li class="previous"><a href="#" onclick="previousweek(\'' . 
	date( 'Y-m-d' ,  strtotime ($date)  )	.'\')">&larr; Preview Week</a></li>';
	 
	$tdate =   strtotime ( $_POST['pdate']) ;
	$date = date('Y', $tdate) . "-" .date('m', $tdate) . "-" .date('d', $tdate);
	$tdate = strtotime ( '7 day' , strtotime ( $date ) ) ;
	$date = date('Y', $tdate) . "-" .date('m', $tdate) . "-" .date('d', $tdate);
	 
	 echo '<li class="next"><a href="#" onclick="nextweek(\'' . date( 'Y-m-d' ,  strtotime ($date)  ) .'\')">Next Week &rarr;</a></li></ul>'; 
	 echo "</div>"; 
		
}
	
	
	
	

if(isset($_POST['ndate']))
{

	$tdate =   strtotime ( $_POST['ndate']) ;
	$date = date('Y', $tdate) . "-" .date('m', $tdate) . "-" .date('d', $tdate);
	
	 
	for($day= 1; $day <= 7; $day++)
	{
		echo "<li><a href='#'  onclick=\"loadtimesheetfordate('" .   date( 'Y-m-d' ,  strtotime ($date)  ) . "')\">" .
		 date( 'D' ,  strtotime ($date)  ) . "<br/>" .  date( 'd' ,  strtotime ($date)  )  . "</a></li>"; 
		
		$tdate = strtotime ( '1 day' , strtotime ( $date ) ) ;
		$date = date('Y', $tdate) . "-" .date('m', $tdate) . "-" .date('d', $tdate);
		
		
		
	} 
	
	
}
	 
	 
	 
if(isset($_POST['nndate']) && isset($_POST['datenavi']))
{ 
	 
	 $tdate =   strtotime ( $_POST['nndate']) ;
	$date = date('Y', $tdate) . "-" .date('m', $tdate) . "-" .date('d', $tdate);
	$tdate = strtotime ( '-7 day' , strtotime ( $date ) ) ;
	$date = date('Y', $tdate) . "-" .date('m', $tdate) . "-" .date('d', $tdate);
	 
	  
	echo "<div class='week-navigation'>"; 
	echo '<ul class="pager"><li class="previous"><a href="#" onclick="previousweek(\'' . 
	date( 'Y-m-d' ,  strtotime ($date)  )	.'\')">&larr; Preview Week</a></li>';
	 
	$tdate =   strtotime ( $_POST['nndate']) ;
	$date = date('Y', $tdate) . "-" .date('m', $tdate) . "-" .date('d', $tdate);
	$tdate = strtotime ( '7 day' , strtotime ( $date ) ) ;
	$date = date('Y', $tdate) . "-" .date('m', $tdate) . "-" .date('d', $tdate);
	 
	 echo '<li class="next"><a href="#" onclick="nextweek(\'' . date( 'Y-m-d' ,  strtotime ($date)  ) .'\')">Next Week &rarr;</a></li></ul>'; 
	 echo "</div>"; 
	 
	 
	 
		
}
	

	
	
	
	
?>
