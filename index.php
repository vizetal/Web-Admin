<?php
	session_start();
	/*Create DIRS*/
	if (!is_dir("../recent_images")) {
			mkdir("../recent_images");         
		}
		
		if (!is_dir("../gallery")) {
			mkdir("../gallery");         
		}	
	if(isset($_SESSION['name']))
		header("location: home.php");
	  if(isset($_REQUEST['button']))
	  {
		include("connect-db.php");
		$uname  = $_POST['user'];
		$pwd  = $_POST['pass'];
		$result =  mysql_query("SELECT * FROM admin WHERE uname='$uname' AND pass='$pwd'");
		if(mysql_num_rows($result)!=0)
			{
				
				$_SESSION['name']=$uname;
				header("location: home.php");
			}
			else
			{
				$err_msg='	<div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert">&times;</a>
							<strong>Warning!</strong> There was a problem with your username or password.
							</div>';
			}
		  }
	  
	  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>ADMIN | samakhya</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container" style="width:400px;">
  <h2>ADMIN | <small>Samakhya</small></h2>
  <form role="form" method="post">
    <div class="form-group">
      <label for="user">Username:</label>
      <input type="text" class="form-control" id="user" name="user" placeholder="User name">
    </div>
    <div class="form-group">
      <label for="pass">Password:</label>
      <input type="password" class="form-control" id="pass" name="pass" placeholder="Enter password">
    </div>
    <button type="submit" class="btn btn-default" name="button">Submit</button>
  </form>
  <br/>
  <?php echo (isset($err_msg))?$err_msg:""; ?>
</div>

</body>
</html>
