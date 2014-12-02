<?php

mysql_connect("localhost", "root", "");
mysql_select_db("tms");

$query = 
	"DELETE	 
	 FROM PassengerTicket 	
	 WHERE id=" . $_GET["id"];
	

$result = mysql_query($query);
echo $result;

if (!$result) {
	die('Invalid query: ' . mysql_error());
}

?>