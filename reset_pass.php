<html>
<head>
<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
<center>
<form id="frmLogin" method="POST">
        <h2 class="form-signin-heading">Forgot Password</h2>
        <div class="input-group">
	  <span class="input-group-addon" id="basic-addon1">User Name</span>
	  <input type="text" name="username" class="form-control" placeholder="Username" required>
	</div>
	<br />
        <button class="form-submit-button"" type="submit">Forgot Password</button> <br />
        <a class="btn btn-lg btn-primary btn-block" href="login.php">Login</a>
      </form>
	  <?php 
	  include 'db.php';
	  if(isset($_POST) & !empty($_POST)){
	$username = mysqli_real_escape_string($connect, $_POST['username']);
	$sql = "SELECT * FROM `login` WHERE username = '$username'";
	$res = mysqli_query($connect, $sql);
	echo print($res);
	$count = mysqli_num_rows($res);
	
	if($count == 1){
		echo $link="<a href='localhost/tm/reset.php?key=".$username."&reset=".$password."'>Click To Reset password</a>";
	}else{
		echo "User name does not exist in database";
	}
}?>
</center>
</body>
</html>