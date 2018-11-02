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
      $username=$row['username'];
      $password=md5($row['password']);
    }
    $link="<a href='localhost/tm/reset.php?key=".$username."&reset=".$password."'>Click To Reset password</a>";
    require_once('phpmail/PHPMailerAutoload.php');
    $mail = new PHPMailer();
    $mail->CharSet =  "utf-8";
    $mail->IsSMTP();
    // enable SMTP authentication
    $mail->SMTPAuth = true;                  
    // GMAIL username
    $mail->Username = "";
    // GMAIL password
    $mail->Password = "";
    $mail->SMTPSecure = "ssl";  
    // sets GMAIL as the SMTP server
    $mail->Host = "smtp.gmail.com";
    // set the SMTP port for the GMAIL server
    $mail->Port = "465";
    $mail->From='';
    $mail->FromName='Password Reset';
    $mail->AddAddress('reciever_email_id', 'reciever_name');
    $mail->Subject  =  'Reset Password';
    $mail->IsHTML(true);
    $mail->Body    = 'Click On This Link to Reset Password '.$password.'';
    if($mail->Send())
    {
      echo "Check Your Email and Click on the link sent to your email";
    }
    else
    {
      echo "Mail Error - >".$mail->ErrorInfo;
    }
  }	
}
?>