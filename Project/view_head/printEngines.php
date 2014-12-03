<?php

$query = '
SELECT id, FORMAT(DATE_FORMAT(DATE_SUB(CURRENT_DATE, INTERVAL yearOfConstruction YEAR), "%Y"), 0) AS age, inServiceState, name
FROM Engine';

$result = mysql_query($query) or die(mysql_error());
		

echo '<table class="makeDataTable">
		<thead>
			<tr>
				<th>Type</th>
				<th>ID Number</th>
				<th>Age</th>
				<th>In Service</th>			
				<th>Delete?</th>
			</tr>		
		</thead>
		<tbody>';

while ($row = mysql_fetch_object($result)) {		
	echo '<tr>
					<td>' . $row->name . '</td>
					<td>' . $row->id . '</td>
					<td>' . $row->age . ' years</td>
					<td>' . $row->inServiceState . '</td>
					<td> 
						<form action="index.php" method="post">
							<input type="hidden" name="deleteEngine" value="' . $row->id . '"> 
							<input type="submit" value="Delete">
						</form>
					</td>
				</tr>';
}

echo '</tbody></table>';

?>