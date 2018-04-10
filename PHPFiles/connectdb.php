<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SqlConnect</title>
</head>

<body>
<?php
$conn_error = 'could not connect';
$mysql_host = 'localhost';
$mysql_user='root';
$mysql_pass='';

$mysql_db = 'dogs';

if(!@mysql_connect($mysql_host,$mysql_user,$mysql_pass) || !@mysql_select_db($mysql_db))  {
	//mysql_connect -> connect to server to access database
	//mysql_select_db -> for selecting database
	die($conn_error);
}


?>
</body>
</html>