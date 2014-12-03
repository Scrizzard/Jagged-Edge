<?php

$query = '
SELECT name, fuelType, yearOfInvention, inventor, countryOfOrigin, maxCarPull
FROM EngineType';

$result = mysql_query($query) or die(mysql_error());
		

echo '<table class="makeDataTable">
		<thead>
			<tr>
				<th>Name</th>
				<th>Fuel Type</th>
				<th>Max Cars</th>
				<th>Designed in</th>			
				<th>Designed by</th>
				<th>Country of Origin</th>
				<th>Delete?</th>
			</tr>		
		</thead>
		<tbody>';

while ($row = mysql_fetch_object($result)) {		
	echo '<tr>
					<td>' . $row->name . '</td>
					<td>' . $row->fuelType . '</td>
					<td>' . $row->maxCarPull . ' cars</td>
					<td>' . $row->yearOfInvention . '</td>
					<td>' . $row->inventor . '</td>
					<td>' . $row->countryOfOrigin . '</td>
					<td> 
						<form action="index.php" method="post">
							<input type="hidden" name="deleteEngineType" value="' . $row->name . '"> 
							<input type="submit" value="Delete">
						</form>
					</td>
				</tr>';
}

echo '</tbody></table>';

?>