<?php

include '../shared/db_connection.php';
$query = 
	"SELECT * 
	 FROM Voyage 
	 INNER JOIN TrainRoute
	 ON Voyage.routeID = TrainRoute.routeID";


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