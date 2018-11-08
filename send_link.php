<?php
include 'db.php';
if(isset($_POST['submit_username']) && $_POST['username'])
{
  $username = $_POST['username'];
  $select = mysqli_query($connect,"select username,password from login where username='$username'");
  if(mysqli_fetch_array($select)==1)
  {
    while($row=mysqli_fetch_array($select))
    {
      echo $username=$row['username'];
      echo $password=md5($row['password']);
    exit;
	}
    $link="<a href='localhost/tm/reset.php?key=".$username."&reset=".$password."'>Click To Reset password</a>";
		require('phpmailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$subject = "Test Mail using PHP mailer";
		$content = "<b>This is a test mail using PHP mailer class.</b>";
		$mail->IsSMTP();
		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = TRUE;
		$mail->SMTPSecure = "tls";
		$mail->Port     = 587;  
		$mail->Username = "your gmail username";
		$mail->Password = "your gmail password";
		$mail->Host     = "smtp.gmail.com";
		$mail->Mailer   = "smtp";
		$mail->SetFrom("vincy@phppot.com", "PHPPot");
		$mail->AddReplyTo("vincy@phppot.com", "PHPPot");
		$mail->AddAddress("recipient address");
		$mail->Subject = $subject;
		$mail->WordWrap   = 80;
		$mail->MsgHTML($content);
		$mail->IsHTML(true);
if(!$mail->Send()) 
	echo "Problem on sending mail";
	else 
echo "Mail sent";
}
}
?>