<?php

include '../shared/db_connection.php';

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