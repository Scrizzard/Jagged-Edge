<?php

$query1 = '
SELECT carID, numberofSeats, class, inService
FROM PassengerCar 
	JOIN Car ON Car.id = PassengerCar.carID';

$query2 = '
SELECT carID, baggageCapacity, inService
FROM BaggageCar
	JOIN Car ON Car.id = BaggageCar.carID';

$query3 = '
SELECT carID, passengerLimit, inService
FROM DiningCar
	JOIN Car ON Car.id = DiningCar.carID';

$result1 = mysql_query($query1) or die(mysql_error());
$result2 = mysql_query($query2) or die(mysql_error());
$result3 = mysql_query($query3) or die(mysql_error());
		

echo '
<h3>Passenger Cars</h3>
	<table class="makeDataTable">
		<thead>
		<tr>
			<th>ID Number</th>
			<th>Seats</th>
			<th>Base Cost Multiplier</th>		
			<th>In Service?</th>
			<th>Delete?</th>
		</tr>
		</thead>
		<tbody>
		';

while ($row = mysql_fetch_object($result1)) {		
	echo '<tr>
					<td>' . $row->carID . '</td>
					<td>' . $row->numberofSeats . '</td>
					<td>' . $row->class . '</td>
					<td>' . $row->inService . '</td>
					<td> 
						<form action="index.php" method="post">
							<input type="hidden" name="deleteCar" value="' . $row->carID . '"> 
							<input type="submit" value="Delete">
						</form>
					</td>
				</tr>';
}

echo '</tbody></table>';


echo '
<h3>Baggage Cars</h3>
	<table class="makeDataTable">
		<thead>
			<tr>
				<th>ID Number</th>
				<th>Baggage Capacity</th>	
				<th>In Service?</th>
				<th>Delete?</th>
			</tr>		
		</thead>
		<tbody>';

while ($row = mysql_fetch_object($result2)) {		
	echo '<tr>
					<td>' . $row->carID . '</td>
					<td>' . $row->baggageCapacity . '</td>
					<td>' . $row->inService . '</td>
					<td> 
						<form action="index.php" method="post">
							<input type="hidden" name="deleteCar" value="' . $row->carID . '"> 
							<input type="submit" value="Delete">
						</form>
					</td>
				</tr>';
}

echo '</tbody></table>';


echo '
<h3>Dining Cars</h3>
	<table class="makeDataTable">
		<thead>
			<tr>
				<th>ID Number</th>
				<th>Passenger Capacity</th>	
				<th>In Service?</th>
				<th>Delete?</th>
			</tr>
		</thead>
		<tbody>
		';

while ($row = mysql_fetch_object($result3)) {		
	echo '<tr>
					<td>' . $row->carID . '</td>
					<td>' . $row->passengerLimit . '</td>
					<td>' . $row->inService . '</td>
					<td> 
						<form action="index.php" method="post">
							<input type="hidden" name="deleteCar" value="' . $row->carID . '"> 
							<input type="submit" value="Delete">
						</form>
					</td>
				</tr>';
}

echo '</tbody></table>';

?>