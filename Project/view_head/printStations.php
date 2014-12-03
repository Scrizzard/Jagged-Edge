<?php

$query = '
SELECT name, latitude, longitude, address
FROM TrainStation';

$result = mysql_query($query) or die(mysql_error());
		

echo '<table class="makeDataTable">
		<thead>
			<tr>
				<th>Name</th>
				<th>Coordinates</th>
				<th>Address</th>			
				<th>Delete?</th>
			</tr>
		</thead>
		<tbody>
		';

while ($row = mysql_fetch_object($result)) {		
	echo '<tr>
					<td>' . $row->name . '</td>
					<td>' . $row->latitude .',<br>' . $row->longitude . '</td>
					<td>' . $row->address . '</td>
					<td> 
						<form action="index.php" method="post">
							<input type="hidden" name="deleteStation" value="' . $row->name . '"> 
							<input type="submit" value="Delete">
						</form>
					</td>
				</tr>';
}

echo '</tbody></table>';

?>