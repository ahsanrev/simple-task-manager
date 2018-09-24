<html>
<head>
<title>Registration</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<center>
<form action="" method="post" id="signup">
	<div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>
<div class="field-group">
		<div><label for="fname">Full Name</label></div>
		<div><input name="fname" type="text" class="input-field" required></div>
	</div>	
	<div class="field-group">
		<div><label for="signup">Username</label></div>
		<div><input name="username" type="text" class="input-field" required></div>
	</div>
	<div class="field-group">
		<div><label for="password">Password</label></div>
		<div><input name="password" type="password" class="input-field" required> </div>
	</div>
	<div class="field-group">
		<div><input type="submit" name="signup" value="signup" class="form-submit-button"></span></div>
	</div>  
	

<?php
include 'db.php';


if (isset($_POST['signup'])) {
  
$fname = $_POST["fname"] ;
$username = $_POST["username"];
$password = $_POST["password"];
$sql = "INSERT INTO login (fname, username, password)
VALUES ('$fname', '$username', MD5('$password'))";
(mysqli_query($connect, $sql));
echo "Your Account Has Been Created! - "; echo '<a href="login.php">Login</a>';
}

?>
</center>	
</form>
</body>
</html>