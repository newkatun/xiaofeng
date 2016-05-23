<?php 
$link = mysql_connect('76.163.252.195','A941323_bsuer','Bshuo123456'); 
if (!$link) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
} 
echo 'Connection OK'; mysql_close($link); 
?> 