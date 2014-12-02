<html>
  <head>
        <title>Your Schedule</title>
    </head>
    <body>
        <table>
	        <thead>
			   <tr>
	                <td>Station of Origin</td>
	                <td>Terminal Station</td>
					<td>Departure Date</td>
					<td>Departure Time</td>
					<td>Arrival Date</td>
					<td>Arrival Time</td>
	            </tr>
	        </thead>
			<tbody>
		
				<?php
				$SERVER = 'localhost';
					$USER = 'root';
					$PASSWORD = 'openSesame';
					$DATABASENAME = 'TMS';
				
					$DBC = mysql_connect($SERVER, $USER, $PASSWORD);
					mysql_select_db($DATABASENAME);
				
				
				
					$query =
					"SELECT stationOfOrigin, terminalStation, departureDate, departureTime, arrivalDate, arrivalTime FROM EmployeeVoyagePair
					INNER JOIN Voyage
					ON employeeVoyagePair.voyageID = Voyage.id
					INNER JOIN TrainRoute
					ON Voyage.routeID = TrainRoute.routeID
					WHERE employeeID =".$_POST['employeeID'];
				
					$result = mysql_query($query);
					if (!$result) 
					{
						die('Invalid query: ' . mysql_error());
					}
				
					else
					{
						$rows = array();
						while($row = mysql_fetch_array($result)){
						?>
				                <tr>
				                    <td><?php echo $row['stationOfOrigin']?></td>
				                    <td><?php echo $row['terminalStation']?></td>
									<td><?php echo $row['departureDate']?></td>
									<td><?php echo $row['departureTime']?></td>
									<td><?php echo $row['arrivalDate']?></td>
									<td><?php echo $row['arrivalTime']?></td>
				                </tr>
				
				            <?php
						}
					}
				?>
			</tbody>
		</table>
	</body>
</html>
