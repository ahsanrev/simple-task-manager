<html>
<head>

<link rel="stylesheet" type="text/css" href="style/style.css">
<?php 
error_reporting(0);
session_start();
$value = $_SESSION['user_id'];
$value1 = $_SESSION['name'];
if($value != ""){
	header('Location: index.php');
}
	?>
</head>
<body>
<center>
<form action="" method="post" id="frmLogin">
	<div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>	
	<div class="field-group">
		<div><label for="login">Username</label></div>
		<div><input name="username" type="text" class="input-field" required></div>
	</div>
	<div class="field-group">
		<div><label for="password">Password</label></div>
		<div><input name="password" type="password" class="input-field" required> </div>
	</div>
	<div class="field-group">
		<div><input type="submit" name="login" value="Login" class="form-submit-button"></span></div>
	  <a href="signup.php">Create Account</a>  |  <a href="reset_pass.php">Forget Password</a>
	</div>  
<?php

include 'db.php';
session_start();
if(!empty($_POST["login"])) {
	$result = mysqli_query($connect,"SELECT * FROM login WHERE username='" . $_POST["username"] . "' and password = MD5('". $_POST["password"]."')");
    $row  = mysqli_fetch_array($result);
	if(is_array($row)) {
	$_SESSION["user_id"] = $row['user_id'];
	$_SESSION["name"] = $row['name'];
	header('Location: index.php');
	} else {
		echo "Wrong Username & Password";
	}
}	
?>
</center>	
</form>
</body>
</html>