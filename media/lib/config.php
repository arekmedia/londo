<?php
$host	= "localhost";
$user	= "root";
$pass	= "";
$db		= "lowongan";

mysql_connect($host,$user,$pass) or die('Unable to connect');
mysql_select_db($db);

?>