<?php
session_start();
require 'connectdb.php';
?>
<html>
<head>
</head>
<body>
<?php
$get = $_GET['q'];

 if($get!="") {
$_SESSION['amma']=1;
$total=0;

$query2 = "select * from w_dogs where name='$get'";
		if($query_run = mysql_query($query2)) {
			$query_num_rows = mysql_num_rows($query_run);
			if($query_num_rows ==1) {
				$amount =  mysql_result ($query_run , 0 , 'price');
				$query_set3 = "update w_dogs set isselect=1 where name='$get'";
				mysql_query($query_set3); 
			}
		}
		
		
$query2 = "select * from w_birds where name='$get'";
		if($query_run = mysql_query($query2)) {
			$query_num_rows = mysql_num_rows($query_run);
			if($query_num_rows ==1) {
				$amount =  mysql_result ($query_run , 0 , 'price');
				$query_set3 = "update w_birds set isselect=1 where name='$get'";
				mysql_query($query_set3); 
			}
		}
		
		
		
$query2 = "select * from w_cats where name='$get'";
		if($query_run = mysql_query($query2)) {
			$query_num_rows = mysql_num_rows($query_run);
			if($query_num_rows ==1) {
				$amount =  mysql_result ($query_run , 0 , 'price');
				$query_set3 = "update w_cats set isselect=1 where name='$get'";
				mysql_query($query_set3); 
			}
		}
		
		
		
$query2 = "select * from w_fish where name='$get'";
		if($query_run = mysql_query($query2)) {
			$query_num_rows = mysql_num_rows($query_run);
			if($query_num_rows ==1) {
				$amount =  mysql_result ($query_run , 0 , 'price');
				$query_set3 = "update w_fish set isselect=1 where name='$get'";
				mysql_query($query_set3); 
			}
		}
		
		
		
if($_SESSION[$get]=='not clicked') {
	$_SESSION[$get]="clicked";
$query3 = "insert into cart values ('$get','$amount')";
if($query_run = mysql_query($query3)) {
		$query4 = "select * from  cart";
		?>
		<table style="border: 1px solid yellow;	padding:7px; margin-left:25px; font-size:20px; color:yellow">
				<tr >
			<th style="border: 1px solid yellow;	padding:7px; border-collapse:separate"> Type </th>
			<th style="border: 1px solid yellow;	padding:7px; border-collapse:separate"> Price </th>
			</tr>
				<?php
	
	if ($query_run=mysql_query($query4)) {
			while($row = mysql_fetch_assoc($query_run)) {
			//assign $row as an asscociative array, each row acts like associative array, and column acts like row's key 
				?>
				<tr >
				<td style="border: 1px solid yellow;	padding:15px; border-collapse:separate">
				<?php
				$Topic = $row['name'];
				echo $Topic;
				?>
				</td>
				<td style="border: 1px solid yellow;	padding:7px; border-collapse:separate">
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
		<td style="border: 1px solid yellow;	padding:7px; border-collapse:separate">Total</td>
		<td style="border: 1px solid yellow;	padding:7px; border-collapse:separate">
		<?php
		echo $total . "Tk";
		?>
		</td>
		</tr>
		</table>
		<?php
		$_SESSION['cart_money']=$total;
}
}
	else {
		$query2 = "delete from cart where name='$get'";
		$_SESSION[$get]="not clicked";
		if($query_run = mysql_query($query2)) {
			
			$query_set = "update w_dogs set isselect=0 where feename='$get'";
			$query_run = mysql_query($query_set);	
			
			$query_set = "update w_cats set isselect=0 where feename='$get'";
			$query_run = mysql_query($query_set);	
			
			$query_set = "update w_birds set isselect=0 where feename='$get'";
			$query_run = mysql_query($query_set);	
			
			$query_set = "update w_fish set isselect=0 where feename='$get'";
			$query_run = mysql_query($query_set);	
			
			 $total=0;
			 $query4 = "select * from  cart";
			 $query_run=mysql_query($query4);
			 $query_num_rows = mysql_num_rows($query_run);
			 if($query_num_rows==0) {
			 	echo "<b style='color:yellow'>You don't select any payment yet</b>";
				$_SESSION['cart_money']=0;
			 }
			else {
		?>
		<table style="border: 1px solid yellow;	padding:7px; margin-left:25px; font-size:20px; color:yellow">
				<tr >
			<th style="border: 1px solid yellow;	padding:15px; border-collapse:separate"> Type </th>
			<th style="border: 1px solid yellow;	padding:7px; border-collapse:separate"> Amount </th>
			</tr>
				<?php
	
	if ($query_run=mysql_query($query4)) {
			while($row = mysql_fetch_assoc($query_run)) {
			//assign $row as an asscociative array, each row acts like associative array, and column acts like row's key 
				?>
				<tr >
				<td style="border: 1px solid yellow;	padding:7px; border-collapse:separate">
				<?php
				$Topic = $row['name'];
				echo $Topic;
				?>
				</td>
				<td style="border: 1px solid yellow;	padding:7px; border-collapse:separate">
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
		<td style="border: 1px solid yellow;	padding:7px; border-collapse:separate">Total</td>
		<td style="border: 1px solid yellow;	padding:7px; border-collapse:separate">
		<?php
		echo $total . "Tk";
		?>
		</td>
		</tr>
		</table>
		<?php
		$_SESSION['cart_money']=$total;
			}
		}
	}
}


?>		
</body>
</html>	
