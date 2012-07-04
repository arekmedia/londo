<?php
$host	= "localhost";
$user	= "lowongan";
$pass	= "t3rs3r4h";
$db		= "lowongan";

mysql_connect($host,$user,$pass) or die('Unable to connect');
mysql_select_db($db);

?>