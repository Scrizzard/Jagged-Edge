<?php

mysql_connect("localhost", "root", "");
mysql_select_db("tms");

$query = "SELECT routeID, stationOfOrigin, terminalStation
		  FROM TrainRoute";


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