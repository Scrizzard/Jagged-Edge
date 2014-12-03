<?php

echo '<form action="index.php" method="post">
				<input type="hidden" name="newEngineType" value="newEngineType">
				<table>
					<tr>
						<td>Name</td>
						<td><input type="text" limit="255" name="name"></td>
					</tr>
					<tr>
						<td>Fuel Type</td>
						<td><input type="text" limit="255" name="fuel"></td>
					</tr>
					<tr>
						<td>Max Cars</td>
						<td><input type="Number" min="0" step="1" value="35" name="maxCars"></td>
					</tr>					
					<tr>
						<td>Year of Design</td>
						<td><input type="Number" min="0" step="1" value="2000" name="year"></td>
					</tr>
					<tr>
						<td>Designer Name</td>
						<td><input type="text" limit="255" name="designer"></td>
					</tr>
					<tr>
						<td>Contry of Origin</td>
						<td><input type="text" limit="255" name="origin"></td>
					</tr>		
				</table>

				<input type="submit" value="Add Engine Type">
			</form>';


?>