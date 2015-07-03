<?php
	session_start();
	include("config/db.php"); 
	//if checkout then log the user out
	session_destroy(); 
	global $user_name;
?>
<?php  include_once('template/header.php'); ?>
 
  
<div class="row page-area">

  <div class="panel panel-primary" style="width:500px; margin:100px auto;">
    <div class="panel-heading"><i class='glyphicon glyphicon-user'></i> System Message</div>
    <div class="panel-body">
      <form class="form-signin" method="post" action="login.php">
       
          <h4 class="text-center"><strong>You have successfully log out.</strong></h4>
         
          <a class="btn btn-lg btn-success btn-block" href="<?php echo $_REQUEST['redirect']; ?>">
              Sign In
          </a>
          <input type="hidden" name="hdn_submit" value="1">
      </form>
    </div>
  </div>


</div>

 <?php  include_once('template/footer.php'); ?>
