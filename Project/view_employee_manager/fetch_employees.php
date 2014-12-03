<?php

$query = 'SELECT name, title, yearsOfEmployment, id FROM Employees';

$result = mysql_query($query);

//result will be false for a bad query
if (!$result) {
	die('There was an error: ' . mysql_error());
}				

echo '<table>
		<thead>
			<tr>
				<th>Name</th>
				<th>Title</th>
				<th>Years of Employment</th>
				<th>Delete?</th>
			</tr>
		</thead><tbody>';

while ($row = mysql_fetch_object($result)) {		
	echo '<tr>
					<td>' . $row->name . '</td>
					<td>' . $row->title . '</td>
					<td>' . $row->yearsOfEmployment . '</td>
					<td> 
						<form action="./employee_manager.php" method="post">
							<input type="hidden" name="deleteEmployee" value="' . $row->id . '"> 
							<input type="submit" value="Delete">
						</form>
					</td>
				</tr>';
}

echo '</tbody></table>';

?>