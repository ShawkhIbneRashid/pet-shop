<?php
ob_start();
session_start();
require 'connectdb.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Log in </title>
<style>

.background {
  position: absolute;
  height: 100%;
  width: 100%;
  margin:0px;
  padding:0px;
  z-index:-99;
  background-repeat:no-repeat;
  background-size: 100% 100%;
  background-image:url("back.jpg");
}

</style>

</head>

<body style="margin:0px; padding:0px;">

	<div class ="background">
	</div>
	
	<div style="position:absolute; margin-top:12%; background-color:transparent; width:45%; height:330px; color:white; margin-left: 26%;">
		<h1 style="font-size: 49px; background-color:teal ;color:white; text-align:center ; padding:5px"> Login Page </h1>
		
		<form method= "post" action="http://localhost/ratul/login.php" >
		
		<span style="background-color:#666 ;color:white; padding:0.5em; border:0.25em; border-color:#666; height:39px;  font-size:24px; font-weight:bold; margin-bottom:15px"> Account No : </span>
		
		
		<input type="text" name="username2" style="padding:0.6em;border:0.2em solid; font:1.0em 'Montserrat Alternates'; 
		border-color:#666; width:420px; height:25px;background-color:teal ;color:white; font-weight:bold ;margin-bottom:15px"  id="search" placeholder="username" />
		
		<span style="background-color:#666 ;color:white; padding:0.5em; border:0.25em; border-color:#666; height:39px;  font-size:24px; font-weight:bold;"> Password :   </span>
		<input type="password" name="password2" style="padding:0.6em;border:0.2em solid; font:1.0em 'Montserrat Alternates'; border-color:#666; width:442px; height:25px;background-color:teal ;color:white; font-weight:bold"  id="search" placeholder="password" />
		<input type="submit" name="Submit" value="Log in" style="text-align:center; width:30%; padding: 7px; font-weight:bold; font-size:30px; color: white; background-color:#666; margin-left: 33% ; margin-top: 2% "/>
		
		</form>
		
		<h2 style="text-align:center; color:black"> Don't Have an account? </h2>
		<a href="http://localhost/ratul/signup.php" style="  margin-left: 38%;color:black; font-size:24px; font-weight:bold"> Sign up here </a>
		<br /><br />
		<button style=" background-color:grey;  margin-left: 38%"><a href="file:///F:/5th%20semester/project/my/home/new%20%208.html" style="color:black; font-size:24px;  color:white; font-weight:bold"> Homepage </a></button>
		
	</div>
	
<?php
 if (isset($_POST['username2']) && isset($_POST['password2'])) {
 	$username = $_POST['username2'];
	$password = $_POST['password2'];
	
	
	
	if(!empty ($username) && !empty($password)) {
		$query = "select * from information where userid='$username' and password='$password' ";
		if($query_run = mysql_query($query)) {
			$query_num_rows = mysql_num_rows($query_run);
			if($query_num_rows ==0) {
				echo "invalid username/password combination.";
				
			}
		
			else if($query_num_rows==1) {
				echo "username and password matched";
				$user_id = mysql_result($query_run,0,'userid');
				$user_firstname = mysql_result($query_run,0,'username');
				$_SESSION['id2']=$user_id;
				$_SESSION['firstname2']=$user_firstname;
				$query_redirect_to_payment = mysql_result ($query_run,0,'save');
				if($query_redirect_to_payment=='Y') header('Location:paylayout.php');
				else 	header('Location: cart_ratul.php');
				}
		}
	}
 }
	else {
		echo 'you must fill up username and password';
	}
	
?>
	
</body>
</html>	
