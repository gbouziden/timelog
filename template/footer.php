
</br></br></br></br></br></br>
<div class="row footer">
	<div class="col-lg-6 col-lg-offset-3">
		<p class='white text-center'>&copy; BancCentral National Association. A Myers Bancshares, Inc. Solution. 2014 All rights are reserved.</p>
                
	</div>
</div> 
</div> 


<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/timer.js"></script>
<script type="text/javascript">
(function(){
	var hasTimer = false;
	/*
		Init timer start
	*/
	
	<?php
	if($_SESSION['logtime']!=''){
	?>
	hasTimer = true;
	$('.start-timer-btn').addClass('hidden');
	$('.timer').timer({
		duration: '1s',
		callback: function() {
			$.post('index.php', {'logtime': $('.timer').data('seconds')}, function(data){
				$("#check-in-time").html(data); 
			});
		},
		repeat: true //repeatedly calls the callback you specify
	});			
	$('.pause-timer-btn, .remove-timer-btn').removeClass('hidden');
	<?php } ?>
	
	$('.start-timer-btn').on('click', function(){
		hasTimer = true;
		
		$('.timer').timer({
			duration: '1s',
			callback: function() {
				$.post('index.php', {'logtime': $('.timer').data('seconds')}, 
				function(data){ 
					$("#check-in-time").html(data);
				});
			},
			repeat: true //repeatedly calls the callback you specify
		});			
		
		$(this).addClass('hidden');
		$('.pause-timer-btn, .remove-timer-btn').removeClass('hidden');
	});

	/*
		Init timer resume
	*/
	$('.resume-timer-btn').on('click', function(){
		$('.timer').timer('resume');
		$(this).addClass('hidden');
		$('.pause-timer-btn, .remove-timer-btn').removeClass('hidden');
	});


	/*
		Init timer pause
	*/
	$('.pause-timer-btn').on('click', function(){
		$('.timer').timer('pause');
		$(this).addClass('hidden');
		$('.resume-timer-btn').removeClass('hidden');
	});

	/*
		Remove timer
	*/
	$('.remove-timer-btn').on('click', function(){
		hasTimer = false;
		$('.timer').timer('remove');
		$(this).addClass('hidden');
		$('.start-timer-btn').removeClass('hidden');
		$('.pause-timer-btn, .resume-timer-btn').addClass('hidden');
		$.post('index.php', {'checkout': 'checkout'}, function(data){ document.location = 'worklog.php' });
	});
	
})();
</script>

<script type="text/javascript">


	function timerStart()
	{
		 
		$('.start-timer-btn').addClass('hidden');
		$('.pause-timer-btn, .remove-timer-btn').removeClass('hidden');
		$('#test1').timer('start');
		
		$.ajax({
			type: "POST",
			url: "logger.php",
			data: { id: "<?php echo $user_name; ?>", timespan: $('#hidCount').val(), mode: "CHECKIN", log: "true" }
		}); 
		
		
	}

	function timerResume()
	{
		$('.pause-timer-btn').removeClass('hidden');
        $('.resume-timer-btn').addClass('hidden');		
		$('#test1').timer('resume');		
		$.ajax({
				type: "POST",
				url: "logger.php",
				data: { id: "<?php echo $user_name; ?>", timespan: $('#hidCount').val(), mode: "WORK", log: "true" }
		}); 				
	}
 
	 function timerPause()
	 {
		$('.pause-timer-btn').addClass('hidden');
        $('.resume-timer-btn').removeClass('hidden');		
		$('#test1').timer('pause');
		
		$.ajax({
						  type: "POST",
						  url: "logger.php",
						  data: { id: "<?php echo $user_name; ?>", timespan: $('#hidCount').val(), mode: "PAUSE" , log: "true"}
						});
						
						
	 }
	 
	 function timerStop()
	 {
		$.ajax({
						  type: "POST",
						  url: "logger.php",
						  data: { id: "<?php echo $user_name; ?>", timespan:  $('#hidCount').val(), mode: "CHECKOUT" , log: "true"}
						}); 
						
		$('#test1').timer('stop');
		
		setTimeout(function () {
			window.location.replace('index.php');
		}, 1000);		
		
		
	}
	 
		 
		$('#test1').timer({
			delay: 1000,
			repeat: true,
			autostart: false,
			callback: function( index ) 
			{ 
			  
				sec = index ; 
				hr = parseInt (sec / 3600 );
				min = parseInt ((sec % 3600) / 60);				
				sec = parseInt ((sec % 3600) %60);
				
				$('#timer').html( hr + ":" + min + ":" + sec  + " hr");
				$('#hidCount').val(index);
				$('#timecounter').html( "" + new Date() );
				
				if(index % 10 == 0)
				{
					//every ten seconds
					
					$.ajax({
							type: "POST",
							url: "logger.php",
							data: { id: "<?php echo $user_name; ?>", timespan: $('#hidCount').val(), mode: "WORK", log: "true" }
					}); 
					
				}
				
			}
		});
		
	  loadtimesheet();	
		
	  function loadtimesheet()
	  { 
	   
	   <?php if(isset($_SESSION['user_name'])) {  ?>
	   $('#timesheetarea').show();
	   <?php } else {?>
	   //alert('You are not logged in. Please log in to view your work time-sheet!');
	   <?php } ?>
	   
	   
		$.ajax({
			type: "POST",
			url: "logger.php",
			data: { id: "<?php echo $user_name; ?>", getlog: "true" }
			})
			.done(function( msg ) {
	 
		$('.grid').html( msg );
			}); 	
	  }
 
 
	function loadtimesheetfordate(date)
	  { 
	   
	   <?php if(isset($_SESSION['user_name'])) {  ?>
	   $('#timesheetarea').show();
	   <?php } else {?>
	   alert('You are not logged in. Please log in to view your work time-sheet!');
	   <?php } ?>
	   
	   
		$.ajax({
			type: "POST",
			url: "logger.php",
			data: { id: "<?php echo $user_name; ?>", logdate:  date }
			})
			.done(function( msg ) {
	 
		$('.grid').html( msg );
			}); 	
	  }
	  
	  function previousweek(bedate)
	  {
			$.ajax({
			type: "POST",
			url: "config/calender.php",
			data: { date:   bedate }
			})
			.done(function( msg )
			{ 
				$('.pagination').html( msg );
			});
			
			$.ajax({
			type: "POST",
			url: "config/calender.php",
			data: { pdate:   bedate, datenavi:   true }
			})
			.done(function( msg )
			{ 
				$('.week-navigation').html( msg );
			});
			
			
	  }
	  
	  
	  function nextweek(bedate)
	  {
			$.ajax({
			type: "POST",
			url: "config/calender.php",
			data: { ndate:   bedate }
			})
			.done(function( msg )
			{ 
				$('.pagination').html( msg );
			});
			
			 $.ajax({
			type: "POST",
			url: "config/calender.php",
			data: { nndate:   bedate, datenavi:   true }
			})
			.done(function( msg )
			{ 
				$('.week-navigation').html( msg );
			});
			 
	  }
	   
	  
</script>
	 
	
</body>
</html>
