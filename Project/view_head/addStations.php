<?php

$trackOptions = printTracksOptions();

echo '<form action="index.php" method="post">
				<input type="hidden" name="newStation" value="newStation">
				<table>
					<tr>
						<td>Name</td>
						<td><input type="text" limit="255" name="name"></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><input type="text" limit="255" name="address"></td>
					</tr>
					<tr>
						<td>Latitude</td>
						<td><input type="text" limit="255" name="latitude"></td>
					</tr>
					<tr>
						<td>Longitude</td>
						<td><input type="text" limit="255" name="longitude"></td>
					</tr>
				</table>
				<input type="submit" value="Add Station">
			</form>';


?>