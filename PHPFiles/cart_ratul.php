<?php
session_start();
$_SESSION['amma']=0;
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="w3css.css">
<title>Second Phase</title>

<style>
	.td1 {
		padding: 25px;
		font-size:20px;
		padding-left:35px;
	}
	
	.td2 {
		padding-left:120px;	
		border: 1px solid white;
		padding-right:100px;
		color:white;
		padding-top:10px;
		padding-bottom:10px;
		font-weight:bold;
	}

</style>

<script type="text/javascript">
function showcart(str) {
if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } 
		else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("cart").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","loading.php?q="+str,true);
        xmlhttp.send();
}

</script>

</head>


<?php
	require 'connectdb.php';
	$user_id=$_SESSION['id2'];
	$user_firstname=$_SESSION['firstname2'];
	$_SESSION['ajaxtot']=0;
	$_SESSION['total'] = 0;
	
	function create_table($query_par) {
		$query2 = "select * from $query_par";
		$query_run2=mysql_query($query2)
			?>
			<br />
			<table style="border: 1px solid white;	padding:10px; margin-left:55px; font-size:20px">
			<tr>
			<th style="border: 1px solid white;	padding:3px; border-collapse:separate"> Type </th>
			<th style="border: 1px solid white;	padding:3px; border-collapse:separate"> Price </th>
			</tr>
			<?php
			
			while($row = mysql_fetch_assoc($query_run2)) {
			//assign $row as an asscociative array, each row acts like associative array, and column acts like row's key 
			?>
			<tr>
				<td style="border: 1px solid white;	padding:12px; border-collapse:separate">
				<?php
				if($row['isselect']==0 || $row['isselect']==1) {
					$_SESSION[$row['name']]='not clicked';
				?>
					<Input type = 'checkbox' Name = "<?php echo $row['name']  ?>" value="<?php echo $row['name']  ?>" onclick='showcart(this.value);'>
				<?php
				}
				
				$Topic = $row['name'];
				echo $Topic;
				?>
				</td>
				<td style="border: 1px solid white;	padding:12px; border-collapse:separate">
				<?php
				$Amount =$row['price'];
				echo $Amount;
				?>
				</td>
				</tr>
				<?php
				
			}
		?>
		</table>
		<Br />
		<?php
		return;
	}
	
	?>

<body style="margin:0px; padding:0px; background-color:#666">
	<img src="logo.jpeg" class="w3-teal" style="width:82.45% ; height:250px; margin:0px; padding:0px; background-color:teal; background-attachment:fixed;">
	
	<div style="float:right; padding-left:15px ;background-color:teal; margin:0px;">
	 <a href="#" style=" text-align:center; color:white; text-decoration:none; padding: 30px; font-size:35px; "> <img src="bellicon1.png" style="height: 50px; width:45px; margin-right:5px;margin-top:13px;">  <?php echo "$user_firstname" ?>  </a></li>  </a>
	 
	 <br /> <br />
	 
	 <a href="http://localhost/ratul/login.php" style=" text-align:center; color:black; text-decoration:none; padding: 60px; font-size:30px;">  <button style="background-color:#666; color:white; margin-bottom:10px; font-weight:bold; font-size:23px"> Log out </button>  </a>
	 
	 </div>
	 
		<div style="margin-left:180px;padding:0px;">
	
	<div style="background-color:teal; width:940px;">
	
	<table class="t2">
	<tr class="tr2">
	
	<td class="td2" style="padding-left:180px;padding-right:160px;">Payment</td>
	<td class="td2" style="padding-left:200px;padding-right:148px;">Cart</td>
	</tr>
	<tr>
	
	<td style="border: 1px solid white;color:white;width:470px;padding-left:10px;">
	<fieldset>
	<legend>
	<p style="font-size:27px">Choose account</p>
	</legend>
	<form aciton="http://localhost/ratul/cart_ratul.php" style="width:100px" method="post">
	<select name="action2">
	<option value="dog" style="font-size:15px">Dogs</option>
	<option value="cat" style="font-size:15px">Cats</option>
	<option value="bird" style="font-size:15px">Birds</option>
	<option value="fish" style="font-size:15px">Fish</option>
	</select>
	</fieldset>
	<br />
	<input type="submit"  name="submit" style="font-size:20px"/>
	</form>
<br/>
<hr />
	<?php
	if( isset($_POST['action2']) ) {
		$select2 = $_POST['action2']; 
		switch ($select2) {
        case 'dog': 
		create_table('w_dogs');
		break;
		case 'cat' :
		create_table('w_cats');
		break;
		case 'bird' :
		create_table('w_birds');
		break;
		case 'fish' :
		create_table('w_fish');
		break;
		default:
		break;
		}
	}
	?>
	<a href="http://localhost/ratul/paylayout.php"><button style=" background-color:yellow; color:teal; font-size:18px; font-weight:bold; margin-left:170px; border:2px solid teal">Done Payment</button></a>
	<br /><br />
	
	<td id="cart" style="border: 1px solid white;width:440px;color:white;padding:7px;">
	<?php
	if($_SESSION['cart_money']==0) {
		echo "<b style='color:yellow'>You don't select any payment yet</b>";
	}
	else if($_SESSION['amma']==0) {
		$total=0;
		$query4 = "select * from  cart";
		?>
		<table style="border: 1px solid white;	padding:7px; margin-left:25px; font-size:20px; color:yellow">
		<tr>
			<th style="border: 1px solid white;	padding:7px; border-collapse:separate"> Type </th>
			<th style="border: 1px solid white;	padding:7px; border-collapse:separate"> Price </th>
		</tr>
		<?php
	
	if ($query_run=mysql_query($query4)) {
			while($row = mysql_fetch_assoc($query_run)) {
			//assign $row as an asscociative array, each row acts like associative array, and column acts like row's key 
				?>
				<tr>
				<td style="border: 1px solid white;	padding:15px; border-collapse:separate">
				<?php
				$Topic = $row['name'];
				echo $Topic;
				?>
				</td>
				<td style="border: 1px solid white;	padding:7px; border-collapse:separate">
				<?php
				$Amount =$row['price'];
				$total=$total+$Amount;
				echo $Amount;
				?>
				</td>
				</tr>
				<?php
				
			}
		}
		?>
		<tr>
		<td style="border: 1px solid white;	padding:7px; border-collapse:separate">Total</td>
		<td style="border: 1px solid white;	padding:7px; border-collapse:separate">
		<?php
		echo $total . "Tk";
		?>
		</td>
		</tr>
		</table>
		<?php
	}
	?>
	<br />
	
	</td>
	</tr>
	</table>
	</div>
	</div>
	
</body>
</html>