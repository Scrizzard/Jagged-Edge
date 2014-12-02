<?php
// query and print out voyages coming up in the next 30 days
// also display engine & cars assigned to the voyage
// also display staff assigned to each voyage
// also include drop-down to add staff to the voyage
	$query = '
	SELECT DISTINCT Voyage.id AS vid, departureDate, departureTime, arrivalDate, arrivalTime, stationOfOrigin, terminalStation, travelTime, Engine.id AS eid, Engine.name AS ename 
	FROM Voyage 
		JOIN TrainRoute ON Voyage.routeID = TrainRoute.routeID 
		JOIN EngineVoyagePair ON Voyage.id = EngineVoyagePair.voyageID 
		JOIN Engine ON EngineVoyagePair.engineID = Engine.id 
	WHERE departureDate >= CURDATE() 
		AND departureDate <= DATE_ADD(CURRENT_DATE, INTERVAL 1 MONTH)
	';

	$result = mysql_query($query) or die(mysql_error());

// add other tables to query and print out result using template below 

	echo '<table>
		<tr>
			<th>Voyage</th> 
			<th>Departure Date</th>
			<th>Arrival Date</th>
			<th>Duration</th>
			<th>Engine</th>
			<th>Cars Assigned</th>
			<th>Staff Assigned</th>
			<th>Add Staff?</th>
			<th>Remove Staff?</th>
		</tr>		
		';

while ($row = mysql_fetch_object($result)) {		
	echo '<tr>
					<td>' . $row->stationOfOrigin . ' to ' . $row->terminalStation . '</td>
					<td>' . $row->departureDate . ' at ' . $row->departureTime . '</td>
					<td>' . $row->arrivalDate . ' at ' . $row->arrivalTime . '</td>
					<td>' . $row->travelTime . ' hours</td>
					<td>' . $row->ename . ' - ' . $row->eid . '</td>
					<td>'; 
					echo printAssignedCars($row->vid); 
					echo '</td>
					<td>'; 
					echo printAssignedEmployees($row->vid); 
					echo '</td>
					<td>';
						echo printStaffToAdd($row->vid);
					echo '</td>
					<td>';
					echo printStaffToRemove($row->vid);
					echo '</td>
				</tr>';
}

echo '</table>';



function printAssignedCars($vid) {
	$retval = '';

	$query1 = '
	SELECT DISTINCT PassengerCar.carID AS cid, numberofSeats 
	FROM PassengerCar
		JOIN CarVoyagePair ON PassengerCar.carID = CarVoyagePair.carID
	WHERE voyageID = ' . $vid . '
	ORDER BY numberofSeats';
	$query2 = '
	SELECT DISTINCT BaggageCar.carID AS cid, baggageCapacity 
	FROM BaggageCar
		JOIN CarVoyagePair ON BaggageCar.carID = CarVoyagePair.carID
	WHERE voyageID = ' . $vid . '
	ORDER BY baggageCapacity';
	$query3 = '
	SELECT DISTINCT DiningCar.carID AS cid, passengerLimit 
	FROM DiningCar
		JOIN CarVoyagePair ON DiningCar.carID = CarVoyagePair.carID
	WHERE voyageID = ' . $vid .'
	ORDER BY passengerLimit';

	$result1 = mysql_query($query1) or die(mysql_error());
	$result2 = mysql_query($query2) or die(mysql_error());
	$result3 = mysql_query($query3) or die(mysql_error());

	
	while ($row = mysql_fetch_object($result1)) {
		$retval = $retval . 'Passenger: ' . $row->numberofSeats . ' seats <br/> ';
	}
	while ($row = mysql_fetch_object($result2)) {
		$retval = $retval . 'Baggage: ' . $row->baggageCapacity . ' bags <br/> ';
	}
	while ($row = mysql_fetch_object($result3)) {
		$retval = $retval . 'Dining: ' . $row->passengerLimit . ' capacity <br/> ';
	}


	return $retval;
}

function printAssignedEmployees($vid) {
	$query = '
	SELECT name, title, id 
	FROM Employees 
		JOIN EmployeeVoyagePair ON EmployeeVoyagePair.employeeID = Employees.id 
	WHERE EmployeeVoyagePair.voyageID = ' . $vid;
	$result = mysql_query($query) or die(mysql_error());
	while ($row = mysql_fetch_object($result)) {
		echo $row->name . ': ' . $row->title . ' <br/> ';
	}
}

function printStaffToAdd($vid) {
	$query = '
	SELECT name, id 
	FROM Employees 
	WHERE id NOT IN (
		SELECT employeeID
		FROM EmployeeVoyagePair
		WHERE voyageID = ' . $vid . '
		)';
	$result = mysql_query($query) or die(mysql_error());


	$retval = '
	<form action="index.php" method="post">
		<input type="hidden" name="addEmployeeToVoyage" value="addEmployeeToVoyage"> 
		<input type="hidden" name="voyageID" value="' . $vid . '"> 
		<select name="employeeID">';

	while ($row = mysql_fetch_object($result)) {
		$retval = $retval . '<option value="' . $row->id . '">' . $row->name . '</option>';
	}

	$retval = $retval . '
		</select>
		<input type="submit" value="Add">
	</form>';

	return $retval;
}

function printStaffToRemove($vid) {
	$query = '
	SELECT name, id 
	FROM Employees 
	WHERE id IN (
		SELECT employeeID
		FROM EmployeeVoyagePair
		WHERE voyageID = ' . $vid . '
		)';
	$result = mysql_query($query) or die(mysql_error());


	$retval = '
	<form action="index.php" method="post">
		<input type="hidden" name="removeEmployeeFromVoyage" value="removeEmployeeFromVoyage"> 
		<input type="hidden" name="voyageID" value="' . $vid . '"> 
		<select name="employeeID">';

	while ($row = mysql_fetch_object($result)) {
		$retval = $retval . '<option value="' . $row->id . '">' . $row->name . '</option>';
	}

	$retval = $retval . '
		</select>
		<input type="submit" value="Remove">
	</form>';

	return $retval;
}

?>