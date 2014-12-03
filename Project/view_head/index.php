<!-- 
add, update, or delete:
Train Routes
Track Sections
Train Stations
Engines
Engine Type
Cars (Passenger, Dining, and Baggage)
-->

<?php
	include '../shared/db_connection.php';
	// If there's a post request, process that before loading the rest of the page...
	include 'handlePostRequests.php';		
?>

<html>
	<head>		
		<script type="text/javascript" src="../shared/jQuery/external/jquery/jquery.js"></script>
		<script type="text/javascript" src="../shared/jQuery/jquery-ui.js"></script>
		<script type="text/javascript" src="../shared/DataTables/js/jquery.dataTables.js"></script>
		<script type="text/javascript">
		window.onload = function(){
			$("#accordion").accordion({heightStyle: "content", collapsible: true});
			$(".makeDataTable").DataTable({"bJQueryUI": true});
			$("#return, [type='submit']").button();
		};
		</script>
		
		<link href="../shared/DataTables/css/jquery.dataTables.css" type="text/css" rel="stylesheet">
		<link href="../shared/jQuery/jquery-ui.css" type="text/css" rel="stylesheet">
		<link href="../shared/jQuery/jquery-ui.structure.css" type="text/css" rel="stylesheet">
		<link href="../shared/jQuery/jquery-ui.theme.css" type="text/css" rel="stylesheet">
		<link href="../shared/style.css" type="text/css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto">

		
		<link rel="stylesheet" type="text/css" href="../shared/style.css">
 		<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
		<title>Head Office</title>
	</head>
	<body>
		<a id="return">Return to Index</a>

		<p id="pageTitle">Train Management System: Head Office View</p>
		<p id="subtitle">Alter integral, seldom-changing information</p>

		<div id="accordion">

			<h3>Train Routes</h3>
			<div>
			<?php 
				include './printRoutes.php';
			?>
			</div>

			<h3>Track Sections</h3>
			<div>
			<?php
			// query and print out current Track Sections, each with a link to delete them, or change their inService status
				include 'printTracks.php';
			?>
			</div>

			<h3>Add Track Section</h3>
			<div>
			<?php
				include 'addTracks.php';
			?>
			</div>
			
			<h3>Train Stations</h3>
			<div>
			<?php
			// query and print out current Train Stations, each with a link to delete them, or change their inService status
				include 'printStations.php';
			?>
			</div>
			
			<h3>Add Train Stations</h3>
			<div>
			<?php
				include 'addStations.php';
			?>
			</div>
			
			<h3>Engines</h3>
			<div>
			<?php
			// query and print out current Engines, each with a link to delete them, or change their inService status
				include 'printEngines.php';
			?>
			</div>
			
			<h3>Add Engines</h3>
			<div>
			<?php
				include 'addEngines.php';
			?>
			</div>

			<h3>Engine Types</h3>
			<div>
			<?php
			// query and print out current Engine Types, each with a link to delete them
				include 'printEngineTypes.php';
			?>
			</div>
			
			<h3>Add Engine Types</h3>
			<div>
			<?php
				include 'addEngineTypes.php';
			?>
			</div>
			
			<h3>Cars</h3>
			<div>
			<?php
			// query and print out current Cars, each with a link to delete them
				include 'printCars.php';
			?>
			</div>
			
			<h3>Add Cars</h3>
			<div>
			<?php
				include 'addCars.php';
			?>
			</div>
			
		</div>

	</body>
</html>