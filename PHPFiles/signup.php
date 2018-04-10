<?php 
session_start();
ob_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration Form</title>
</head>

<body style="z-index:-99;  background-repeat:no-repeat; background-size: 100% 100%; background-image:url("signback.jpeg");">
<?php
	require 'connectdb.php';
?>

<?php

	



	if(isset($_POST['firstname'])  && isset($_POST['add']) && isset($_POST['phnnum']) && isset($_POST['email']) && isset($_POST['id']) && isset($_POST['pass']) && isset($_POST['passAgain'])  ) {
		
		$first_name = $_POST['firstname'];
		$phn_num = $_POST['phnnum'];
		$mail = $_POST['email'];
		$address=$_POST['add'];
		$user_id = $_POST['id'];
		$passi = $_POST['pass'];
		$passr = $_POST['passAgain'];
		
		if(empty($first_name)) {
			$first_name =   "Warning : Name Required";
		}
		
		if(empty($phn_num)) {
			$phn_num = " Warning : Contact Required";
		}
		
		if(empty($address)) {
			$address = " Warning : Address Required";
		}
		
		if(empty($user_id) ) {
			$uni_id =  "Warning : ID Required" ; 
		}
		
		if(empty($passi) || empty($passr) )  {
			echo  "Warning : Password Required" .  "<br>"; 
		}
		
		
		if (!empty($passi) && !empty($passr) && $passi != $passr) {
				echo "Warning : Password field empty or doesn't match". "<Br>";	
		}
		

		
 
		
		if(!empty($first_name) && !empty($address)  && !empty($phn_num) && !empty($mail) && !empty($user_id) && !empty($passi) && !empty($passr)  ) {
			
			if(!strpos ($first_name,"Warning") && !strpos($last_name,"Warning") && !strpos($phn_num,"Warning") && !strpos($uni_id,"Warning") && !strpos($acc_ext,"Warning")) {
				
				if($passi == $passr) { 
						$_SESSION['firstname']=$first_name;
		  				$_SESSION['add'] =$address;
		  				$_SESSION['phnnum']  = $phn_num;
		  				$_SESSION['email'] = $mail;
		  				$_SESSION['id'] = $user_id;
		  				$_SESSION['pass'] = $passi;
		 				$_SESSION['passAgain'] = $passr;
						 
						 $query = "insert into information (userid,username,contact,password,address,email) values ('$user_id','$first_name','$phn_num','$passi','$address','$mail')";
						 mysql_query($query);		
						 
						 header('file:///F:/5th%20semester/project/my/home/new%20%208.html');				 
				}
				
			}

			
		}
	}
		$first_name = $_SESSION['firstname'];
		$uni_id = $_SESSION['id'];
		$address = $_SESSION['address'];
		$phn_num = $_SESSION['phnnum'];
		$mail = $_SESSION['email'];
	
	?>



<div style=" margin-left:550px; margin-top:50px;">
<h1> Registration Form </h1>
<form method="post" action="http://localhost/ratul/signup.php">
Name : 
<input type="text" style="font-weight:bold"   placeholder="text only" name="firstname" value="<?php echo $first_name ?>"/>
<br /> <br />

Contact No: <input type="text" style=" font-weight:bold"  placeholder="phone number" name="phnnum" value="<?php echo $phn_num ?>" />
<br /><br />
Email : <input type="text"  style=" font-weight:bold"  placeholder="abc@mail.com" name="email" value="<?php echo $mail ?>"/>
<br /> <br />

Address : <input type="text"  style=" font-weight:bold"  name="add" value="<?php echo $address ?>"/>
<br /> <br />


Userid :  <input type="text" style=" font-weight:bold"  placeholder="id number" name="id" value="<?php echo $uni_id ?>"/>
<br /> <br />

Password : <input type="password" style=" font-weight:bold" name="pass" placeholder="give a strong password"/>
<br /> <br />
Retype Password : <input type="password" style= " font-weight: bold" name="passAgain" placeholder="password again" /> 
<br /> <br /> 


<input type="submit" style=" margin-left:100px;width:120px; height:40px; font-size:20px" value="Sign up"/> 
</form>

</div>

</body>
</html>