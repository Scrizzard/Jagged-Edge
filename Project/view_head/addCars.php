<?php

echo '
<h3>Passenger Cars</h3>
<form action="index.php" method="post">
	<input type="hidden" name="newPassengerCar" value="newPassengerCar">
	<table>
		<tr>
			<td>Seats</td>
			<td><input type="Number" min="0" step="1" value="40" name="seats"></td>
		</tr>
		<tr>
			<td>Base Cost Multiplier</td>
			<td><input type="Number" min="0" step="0.1" value="1.0" name="class"></td>
		</tr>
		<tr>
			<td>Currently in Service?</td>
			<td>
				<select name="inService">
					<option value="true">true</option>
					<option value="false">false</option>
				</select>
			</td>
		</tr>							
	</table>

	<input type="submit" value="Add Passenger Car">
</form>';


echo '
<h3>Baggage Cars</h3>
<form action="index.php" method="post">
	<input type="hidden" name="newBaggageCar" value="newBaggageCar">
	<table>
		<tr>
			<td>Baggage Capacity</td>
			<td><input type="Number" min="0" step="1" value="55" name="capacity"></td>
		</tr>
		<tr>
			<td>Currently in Service?</td>
			<td>
				<select name="inService">
					<option value="true">true</option>
					<option value="false">false</option>
				</select>
			</td>
		</tr>							
	</table>

	<input type="submit" value="Add Baggage Car">
</form>';


echo '
<h3>Dining Cars</h3>
<form action="index.php" method="post">
	<input type="hidden" name="newDiningCar" value="newDiningCar">
	<table>
		<tr>
			<td>Passenger Capacity</td>
			<td><input type="Number" min="0" step="1" value="45" name="capacity"></td>
		</tr>
		<tr>
			<td>Currently in Service?</td>
			<td>
				<select name="inService">
					<option value="true">true</option>
					<option value="false">false</option>
				</select>
			</td>
		</tr>							
	</table>

	<input type="submit" value="Add Dining Car">
</form>';

?>