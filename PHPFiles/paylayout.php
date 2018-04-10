<?php
session_start();
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment Bar</title>

</head>

<style>

.vertical {
	margin:0px;
	padding:0px;
	height:100%;
	margin-left:500px;
	position:fixed;
	padding:15px;
}

.sidebar {
	margin:0px;
	width: 450px;	
	background-color : #333;
	border: 1px solid #FFF;
	overflow:auto;
	float:left;
	color: white;
	padding:10px;
	font-size:20px;
}

table,th,td {
		border: 1px solid white;
		border-collapse: separate;
	}
	th,td {
		padding: 15px;
	}
	table {
		border-spacing : 5px;
	}


</style>



<div class="sidebar">

<?php	
	require 'connectdb.php';
	$user_id=$_SESSION['id2'];
	$user_firstname=$_SESSION['firstname2'];
	$query= "select * from information where userid=$user_id";
	$run=mysql_query($query);
	$add = mysql_result ($run,0,'address');
	$contact =  mysql_result ($run,0,'contact');
	$email =  mysql_result ($run,0,'email');
	$total = 0;
	echo "<span style='font-size: 24px; font-weight: bold'> Personal Details </span><br><br>";
	echo "Name : " . $user_firstname . "  "."<Br>"."Address : " .  $add . "<br>Contact : " . $contact . "<br>E-mail : " . $email . "<br><br>";
	
	echo "<h3> Payment Details </h3>";
	
	?>
				<table>
				<tr>
			<th> Type </th>
			<th> Price </th>
			</tr>
				<?php
	
	$query = "select * from cart";
	if ($query_run=mysql_query($query)) {
			while($row = mysql_fetch_assoc($query_run)) {
			//assign $row as an asscociative array, each row acts like associative array, and column acts like row's key 
				?>
				<tr>
				<td>
				<?php
				$Topic = $row['name'];
				echo $Topic;
				?>
				</td>
				<td>
				<?php
				$Amount =$row['price'];
				echo $Amount;
				$total=$total+$Amount;
				?>
				</td>
				</tr>
				<?php
				
			}
		}
		?>
		<tr>
		<td>Total</td>
		<td>
		<?php
		echo $total . "Tk";
		?>
		</td>
		</tr>
		</table>
		<br />
		<br />

</div>

<div class="vertical" id="ver" style=" font-size:18px">
	<h3>How would you like to pay?</h3>
	<table>
	<tr>
	
	<td>
	<button id="id1"  style=" background:none;border:none"> <img src="visa.jpg"  style="height:80; width:120px" />  </button>
	</td>
	
	<td>
	<button id="id2" style=" background:none;border:none"> <img src="master.jpg" style="height:80; width:120px" /> </button>
	</td>
	
	<td>
	<button id="id3" style=" background:none;border:none"> <img src="ria.jpg" style="height:80; width:120px" /> </button>
	</td>
	
	<td>
	<button id="id4"  style=" background:none;border:none"> <img src="ae.jpg"  style="height:80; width:120px" /> </button>
	</td>
	
	</tr>
	</table>
	
	<br />
	<form method="post" action="http://localhost/ratul/paylayout.php">
	<span style="font-size=16px;color:#00C; font-weight:bold;">Cardholder name</span> <br />
	<input type="text" style="font-weight:bold"   placeholder="text only" name="holdername" value="<?php echo $user_firstname . "  " . $user_lastname ?>"/> <br /><br />
	<span style="font-size=16px;color:#00C; font-weight:bold;"> Debit/Credit Card number </span><br />
	<input type="text" style="font-weight:bold"   placeholder="card number" name="cardNumber"/>  <br /><br />
	<span style="font-size=16px;color:#00C; font-weight:bold;"> Expiration Date </span> <br />
	<select name="action">
	<option value="month" >Month</option>
	<option value="month" >January</option>
	<option value="month" > February</option>
	<option value="month" >March</option>
	<option value="month" >April</option>
	<option value="month" >May</option>
	<option value="month" > June</option>
	<option value="month" >July</option>
	<option value="month" >August</option>
	<option value="month" >September</option>
	<option value="month" > October</option>
	<option value="month" >November</option>
	<option value="month" >December</option>
	</select>
	<select name="action2">
	<option value="year" >Year</option>
	<?php
	for($i=2017;$i<=2050;$i++) {
	?>
		<option value="year" ><?php echo $i; ?></option>
	<?php
	}
	?>
	</select>
	<br /><br />
	<span style="font-size=16px;color:#00C; font-weight:bold;">
	Security Code <br /> </span>
	<input type="password" style="font-weight:bold"   placeholder="security" name="cardPassword" />  <br />
	
	<P></P>
	
	<Input type = 'Submit' Name = 'save' Value = 'Save' style='display:inline; width:220px; height:50px; background-color:teal ; color:yellow; font-size:30px; font-weight:bold;'>
	<Input type = 'Submit' Name = 'pay' Value = 'Pay' style='display:inline; margin-left:120px; width:220px; height:50px; background-color:#090 ; color:white; font-size:30px; font-weight:bold;'>
	
	</form>
	<br />
		<form aciton='http://localhost/ratul/paylayout.php' method='post'> 
			<Input type = 'Submit' Name = 'discard' Value = 'Discard' style=' margin-left:170px; width:220px; height:50px; background-color:red ; color:black; font-size:30px; font-weight:bold;'>
 			</form>
			
		<?php
			
			if(isset($_POST['pay'])) {
				
				if(isset($_POST['cardNumber'])  && isset($_POST['action'] ) && isset($_POST['action2']) && isset($_POST['cardPassword']) ) {
				$user_id_card=$_POST['cardNumber'];
				$year =  $_POST['action2'];
				$month = $_POST['action'];
				$expiration = $month." ".$year;
				$query_user_account_balance = "select * from information where cardnumber = '$user_id_card'";
				$run_user_account_balance = mysql_query($query_user_account_balance);
				$balance = mysql_result ($run_user_account_balance,0,'balance');
				$pass = mysql_result ($run_user_account_balance,0,'security');
				$expire = mysql_result ($run_user_account_balance,0,'expired');
			if($balance>=$_SESSION['cart_money'] && $pass==$_POST['cardPassword'] && $expiration=$expire) {
				$update_user_balance = "update information set balance=balance-$total where userid=$user_id";
				mysql_query($update_user_balance);
				$update_dogs_isselect = "update dogs set isselect =0 where isselect=1";
				mysql_query($update_dogs_isselect);
				$update_fish_isselect = "update fish set isselect =0 where isselect=1";
				mysql_query($update_fish_isselect);
				$update_cats_isselect = "update  cats set isselect =0 where isselect=1";
				mysql_query($update_cats_isselect);
				$update_birds_isselect = "update birds set isselect =0 where isselect=1";
				mysql_query($update_birds_isselect);
				$query_delete_cart = "delete from cart where 1=1";
				mysql_query($query_delete_cart);
				
				$query = "update information set save='N' where userid = '$user_id'";
				$query2 = "update information set amount=0 where Username = '$user_id'";
				$query_run=mysql_query($query); $query_run2=mysql_query($query2);
				
			}
				}
			}
			
			else if(isset($_POST['discard'])) {
				$update_dogs_isselect = "update dogs set isselect =0 where isselect=1";
				mysql_query($update_dogs_isselect);
				$update_fish_isselect = "update fish set isselect =0 where isselect=1";
				mysql_query($update_fish_isselect);
				$update_cats_isselect = "update  cats set isselect =0 where isselect=1";
				mysql_query($update_cats_isselect);
				$update_birds_isselect = "update birds set isselect =0 where isselect=1";
				mysql_query($update_birds_isselect);
				$query_delete_cart = "delete from cart where 1=1";
				mysql_query($query_delete_cart);
				$query = "update information set save='N' where userid = '$user_id'";
				$query2 = "update information set amount=0 where Username = '$user_id'";
				$query_run=mysql_query($query); $query_run2=mysql_query($query2);

				header('Location: cart_ratul.php');
			}
			
			else if(isset($_POST['save'])) {
				$query = "update information set save='Y' where userid = '$user_id'";
				$query2 = "update information set amount='$total' where Username = '$user_id'";
				if ($query_run=mysql_query($query) && $query_run2=mysql_query($query2)) {
					echo "Saved";
				}
			}
			
			
			
			
			
		?>

	<hr />
</div>



<body>
</body>
</html>