<?php

include '../shared/db_connection.php';

$query = 
	"SELECT Passenger.id as passengerID, name, nationality, paymentType, phoneNumber
	 FROM Passenger";


$result = mysql_query($query);

if (!$result) {
	die('Invalid query: ' . mysql_error());
}

$rows = array();

while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    $rows[] = $row;
}

echo json_encode($rows);


?>