<?php

$trackOptions = printTracksOptions();

echo '<form action="index.php" method="post">
				<input type="hidden" name="newTrack" value="newTrack">
				<table>
					<tr>
						<td>Start</td>
						<td>
							<select name="stationOfOrigin">' . 
								$trackOptions . '
							</select>
						</td>
					</tr>
					<tr>
						<td>End</td>
						<td>
							<select name="terminalStation">' . 
								$trackOptions . '
							</select>
						</td>
					</tr>
					<tr>
						<td>Currently in Service?</td>
						<td>
							<select name="inServiceState">
								<option value="true">true</option>
								<option value="false">false</option>
							</select>
						</td>
					</tr>
				</table>
				<input type="submit" value="Add Track Section">
			</form>';



function printTracksOptions() {
	$query = 'SELECT name FROM TrainStation';
	$result = mysql_query($query) or die(mysql_error());

	$retval = '';

	while ($row = mysql_fetch_object($result)) {
		$retval = $retval . '<option value="' . $row->name . '">' . $row->name . '</option>';
	}
			
	return $retval;
}


?>