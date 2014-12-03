<?php

$query = '
SELECT routeID, stationOfOrigin, terminalStation, distance, cost, travelTime 
FROM TrainRoute';

$result = mysql_query($query) or die(mysql_error());
		

echo '<table class="makeDataTable">
		<thead>
			<tr>
				<th>Origin</th>
				<th>Destination</th>
				<th>Distance</th>
				<th>Travel Time</th>
				<th>Base Cost</th>
				<th>Stations Visited</th>
				<th>Delete?</th>
			</tr>
		</thead>
		<tbody>
		';

while ($row = mysql_fetch_object($result)) {		
	echo '<tr>
					<td>' . $row->stationOfOrigin . '</td>
					<td>' . $row->terminalStation . '</td>
					<td>' . $row->distance . ' km</td>
					<td>' . $row->travelTime . ' hours</td>
					<td>$' . $row->cost . '</td>
					<td>' . $row->stationOfOrigin;
					echo printStationsVisited($row->routeID);
					echo '</td>
					<td> 
						<form action="index.php" method="post">
							<input type="hidden" name="deleteRoute" value="' . $row->routeID . '"> 
							<input type="submit" value="Delete">
						</form>
					</td>
				</tr>';
}

echo '</tbody></table>';


function printStationsVisited($rid) {
	$retval = '';
	$query = '
	SELECT DISTINCT terminalStation
	FROM SectionRoute
		JOIN TrackSection ON TrackSection.sectionID = SectionRoute.trackSectionID
	WHERE routeID = ' . $rid . '
	ORDER BY orderOfVisitation';
	$result = mysql_query($query) or die(mysql_error());

	while ($row = mysql_fetch_object($result)) {		
		$retval = $retval . ' <br> ' . $row->terminalStation;
	}

	return $retval;
}

?>