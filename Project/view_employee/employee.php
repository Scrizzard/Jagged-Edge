<html>
  <head>
  	
  		<script type="text/javascript" src="../shared/jQuery/external/jquery/jquery.js"></script>
		<script type="text/javascript" src="../shared/jQuery/jquery-ui.js"></script>
		<script type="text/javascript" src="../shared/DataTables/js/jquery.dataTables.js"></script>

		<script type="text/javascript">window.onload = function(){
			$("table").DataTable({"bJQueryUI": true});
			$("#return").button();
			};</script>

		<link href="../shared/DataTables/css/jquery.dataTables.css" type="text/css" rel="stylesheet">
		<link href="../shared/jQuery/jquery-ui.css" type="text/css" rel="stylesheet">
		<link href="../shared/jQuery/jquery-ui.structure.css" type="text/css" rel="stylesheet">
		<link href="../shared/jQuery/jquery-ui.theme.css" type="text/css" rel="stylesheet">
		<link href="../shared/style.css" type="text/css" rel="stylesheet">
		<link type="../text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto">

  	
        <title>Your Schedule</title>
        
    </head>
    <body>
    	
    	<a id="return" href="..">Return to Index</a>
    	
    	<br/><br/>
    	
    	<p id="pageTitle">Your Schedule</p>
    	
    	<br/><br/>
    	
    	<div id="displayTableWrapper">
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
						include '../shared/db_connection.php';
					
					
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
		</div>
	</body>
</html>
