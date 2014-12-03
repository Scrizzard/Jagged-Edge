<?php

$engineTypeOptions = printEngineTypeOptions();

echo '<form action="index.php" method="post">
				<input type="hidden" name="newEngine" value="newEngine">
				<table>
					<tr>
						<td>Type</td>
						<td><select name="type">' . 
								$engineTypeOptions . '
							</select>
						</td>
					</tr>
					<tr>
						<td>Year Of Construction</td>
						<td><input type="Number" min="0" max="3000" step="1" value="2014" name="year"></td>
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

				<input type="submit" value="Add Engine">
			</form>';


function printEngineTypeOptions() {
	$query = 'SELECT name FROM EngineType';
	$result = mysql_query($query) or die(mysql_error());

	$retval = '';

	while ($row = mysql_fetch_object($result)) {
		$retval = $retval . '<option value="' . $row->name . '">' . $row->name . '</option>';
	}
			
	return $retval;
}

?>