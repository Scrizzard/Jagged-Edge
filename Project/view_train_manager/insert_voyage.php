<?php

include '../shared/db_connection.php';


//query the largest ID from the voyage relation
//so we can ensure the inserted tuple will have a unique ID
$idQuery = "SELECT MAX(id) FROM Voyage";
$idResult = mysql_query($idQuery);

if (!$idResult) {
	die('Invalid query: ' . mysql_error());
}

$nextID = mysql_result($idResult, 0) + 1;

//query the travel time of the selected route
//so we can calculate the arrival time

$timeQuery = ('SELECT travelTime FROM TrainRoute WHERE routeID = ' . $_GET["route"]);

$timeResult = mysql_query($timeQuery);

if (!$timeResult) {
	die('Invalid query: ' . mysql_error());
}

$travelTime = mysql_result($timeResult, 0);

//calculate the departure and arrival dates and times
$departureTimestamp = mktime($_GET["hour"], $_GET["minute"], 0, $_GET["month"], $_GET["day"], $_GET["year"]);
$departureTime = date('H:i:s', $departureTimestamp);
$departureDate = date("Y-m-d", $departureTimestamp);

$arrivalTimestamp = mktime($_GET["hour"], $_GET["minute"] + $travelTime, 0, $_GET["month"], $_GET["day"], $_GET["year"]);
$arrivalTime = date('H:i:s', $arrivalTimestamp);
$arrivalDate = date("Y-m-d", $arrivalTimestamp);

//now that our values are assembled,
//perform the insertion
$insertQuery = "INSERT INTO Voyage (id, routeID, departureDate, departureTime, arrivalDate, arrivalTime)
		  VALUES (" . $nextID . ',' . $_GET["route"] . ',"' . $departureDate . '","' . $departureTime . '","' . $arrivalDate . '","' . $arrivalTime . '")';

echo $insertQuery;

$insertResult = mysql_query($insertQuery);

if (!$insertResult) {
	die('Invalid query: ' . mysql_error());
}

?>	