<?php

	if (isset($_POST["deleteRoute"])) {
		$query = 'DELETE FROM TrainRoute WHERE routeID = ' . $_POST["deleteRoute"];
		$results = mysql_query($query) or die(mysql_error());
		
	} elseif (isset($_POST["deleteTrack"])) {
		$query = 'DELETE FROM TrackSection WHERE sectionID = ' . $_POST["deleteTrack"];
		$results = mysql_query($query) or die(mysql_error());
		
	} elseif (isset($_POST["newTrack"])) {
		$query = "INSERT INTO TrackSection VALUES (NULL, '" . $_POST['stationOfOrigin'] . "', '" . $_POST['terminalStation'] . "', " . $_POST['inServiceState'] . ")";
		$result = mysql_query($query) or die(mysql_error());
		
	} elseif (isset($_POST["deleteStation"])) {
		$query = 'DELETE FROM TrainStation WHERE name = "' . $_POST["deleteStation"] .'"';
		$results = mysql_query($query) or die(mysql_error());
		
	} elseif (isset($_POST["newStation"])) {
		$query = "INSERT INTO TrainStation VALUES ('" . $_POST["name"] . "', '" . $_POST["latitude"] . "', '" . $_POST["longitude"] . "', '" . $_POST["address"] . "')";
		$results = mysql_query($query) or die(mysql_error());
		
	} elseif (isset($_POST["deleteEngine"])) {
		$query = 'DELETE FROM Engine WHERE id = ' . $_POST["deleteEngine"];
		$results = mysql_query($query) or die(mysql_error());
		
	} elseif (isset($_POST["newEngine"])) {
		$query = "INSERT INTO Engine VALUES (NULL, '" . $_POST['year'] . "', " . $_POST['inServiceState'] . ", '" . $_POST['type'] . "')";
		$result = mysql_query($query) or die(mysql_error());
		
	} elseif (isset($_POST["deleteEngineType"])) {
		$query = 'DELETE FROM EngineType WHERE name = "' . $_POST["deleteEngineType"] .'"';
		$results = mysql_query($query) or die(mysql_error());
		
	} elseif (isset($_POST["newEngineType"])) {
		$query = "INSERT INTO EngineType VALUES ('" . $_POST["fuel"] . "', " . $_POST["year"] . ", '" . $_POST["designer"] . "', '" . $_POST["origin"] . "', " . $_POST["maxCars"] . ", '" . $_POST["name"] . "')";
		$results = mysql_query($query) or die(mysql_error());
		
	} elseif (isset($_POST["deleteCar"])) {
		$query = 'DELETE FROM Car WHERE id = ' . $_POST["deleteCar"];
		$results = mysql_query($query) or die(mysql_error());
		
	} elseif (isset($_POST["newPassengerCar"])) {
		$query = 'INSERT INTO Car VALUES (NULL, ' . $_POST['inService'] . ')';
		$results = mysql_query($query) or die(mysql_error());
				
		$query = 'INSERT INTO PassengerCar VALUES (' . mysql_insert_id() . ', ' . $_POST["seats"] . ', ' . $_POST["class"] . ')';
		$results = mysql_query($query) or die(mysql_error());


	} elseif (isset($_POST["newBaggageCar"])) {
		$query = 'INSERT INTO Car VALUES (NULL, ' . $_POST['inService'] . ')';
		$results = mysql_query($query) or die(mysql_error());
				
		$query = 'INSERT INTO BaggageCar VALUES (' . mysql_insert_id() . ', ' . $_POST["capacity"] . ')';
		$results = mysql_query($query) or die(mysql_error());

		
	} elseif (isset($_POST["newDiningCar"])) {
		$query = 'INSERT INTO Car VALUES (NULL, ' . $_POST['inService'] . ')';
		$results = mysql_query($query) or die(mysql_error());
				
		$query = 'INSERT INTO DiningCar VALUES (' . mysql_insert_id() . ', ' . $_POST["capacity"] . ')';
		$results = mysql_query($query) or die(mysql_error());

		
	} 

?>