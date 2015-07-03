<?php
session_start();
include("config/db.php");

if($_REQUEST['hdn_submit']=="1"){
	
	$msg = "";
	$user_name = $_REQUEST['user_name'];
	$user_password = $_REQUEST['user_password'];

	if($user_name!='' && $user_password!=''){
		
		$sel_query = "SELECT *FROM tbl_users WHERE user_name='$user_name' AND user_password='$user_password'";
		//die($sel_query);
		$result = mysql_query($sel_query) or die('Unable to fetch result!');
		//die($result->mysql_num_rows());
		
		if(mysql_num_rows($result)>0){
			
			$row = mysql_fetch_array($result);
			
			$_SESSION['user_name'] = $row['user_name'];
			
			header('Location: index.php');
			
		}else{
			
			$msg = "Invalid username and password.";
			
		}
		
	}else{
		
		$msg = "Please enter user name and password.";
		
	}
	
}

?>






<?php include('template/header.php'); ?>


  <div class="panel panel-primary" style="width:300px; margin:100px auto;">
    <div class="panel-heading">User Login</div>
    <div class="panel-body">
      <form class="form-signin" method="post" action="login.php">
      
          <?php if($msg!=''){ ?>
          <p class="bg-primary"><?php echo $msg; ?></p>
          <?php } ?>
      
          <input name="user_name" type="text" class="form-control" placeholder="User Name" required autofocus><br/>
          <input  name="user_password" type="password" class="form-control" placeholder="User Password" required><br/>
          <button class="btn btn-lg btn-primary btn-block" type="submit">
              Sign In
          </button>
          <input type="hidden" name="hdn_submit" value="1">
      </form>
    </div>
  </div>


<?php include('template/footer.php'); ?>
