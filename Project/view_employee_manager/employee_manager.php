<!-- 
view voyages, the Cars and Engine (and Engine Type) assigned to a voyage
create, update and delete Employees 
create, update and delete Employee/Voyage schedule information. 
-->

<?php
	include '../shared/db_connection.php';

	// If there's a post request, process that before loading the rest of the page...

	if (isset($_POST["newEmployee"])) {
		// we're adding a new employee!
		$query = "INSERT INTO Employees VALUES (NULL, '" . $_POST['name'] . "', '" . $_POST['title'] . "', " . $_POST['yearsOfEmployment'] . ")";
		$result = mysql_query($query) or die(mysql_error());
		
	} elseif (isset($_POST["deleteEmployee"])) {
		# we're removing an employee...
		$query = 'DELETE FROM Employees WHERE id = ' . $_POST["deleteEmployee"];
		$results = mysql_query($query) or die(mysql_error());

	} elseif (isset($_POST["addEmployeeToVoyage"])) {
		# we're adding an employee to a voyage!
		$query = "INSERT INTO EmployeeVoyagePair VALUES (" . $_POST['voyageID'] . ", " . $_POST['employeeID'] . ")";
		$result = mysql_query($query) or die(mysql_error());

	} elseif (isset($_POST["removeEmployeeFromVoyage"])) {
		# we're removing an employee from a voyage!
		$query = "DELETE FROM EmployeeVoyagePair WHERE voyageID = " . $_POST['voyageID'] . " AND employeeID = " . $_POST['employeeID'];
		$result = mysql_query($query) or die(mysql_error());
		
	}
	
?>

<html>
	<head>
		<script type="text/javascript" src="../shared/jQuery/external/jquery/jquery.js"></script>
		<script type="text/javascript" src="../shared/jQuery/jquery-ui.js"></script>
		<script type="text/javascript" src="../shared/DataTables/js/jquery.dataTables.js"></script>

		<script type="text/javascript">
		window.onload = function(){ 
			$("#accordion").accordion();
			$("[type='submit'], #return").button();
			$("table").DataTable({"bJQueryUI": true});			
		};
		</script>
		
		<link href="../shared/jQuery/jquery-ui.css" type="text/css" rel="stylesheet">
		<link href="../shared/jQuery/jquery-ui.structure.css" type="text/css" rel="stylesheet">
		<link href="../shared/jQuery/jquery-ui.theme.css" type="text/css" rel="stylesheet">
		<link href="../shared/DataTables/css/jquery.dataTables.css" type="text/css" rel="stylesheet">
		<link href="../shared/style.css" type="text/css" rel="stylesheet">
		<link type="../text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto">
		
		<title>Employee Manager</title>
	</head>
	
	<body>

		<a id="return" href="..">Return to Index</a>
		<p id="pageTitle">Train Management System: Employee Scheduler View</p>
		<p id="subtitle">View, Schedule, Add, and Delete Employees.</p>


		<div id="accordion">
			<h3>Upcoming Voyages</h3>
			<div>
				<?php 
				// query and print out voyages coming up in the next 30 days
				// also display engine & cars assigned to the voyage
				// also display staff assigned to each voyage
				// also include drop-down to add staff to the voyage
				include 'fetch_voyages.php';
				?>
			</div>
	
			<h3>Current Employees</h3>
			<div>
				<?php
				// query and print out current employees, each with a link to delete them
				include 'fetch_employees.php';
				?>
			</div>	
			
			<h3>Add Employee</h3>
			<div>
				<form id="employeeForm" action="./employee_manager.php" method="post">
					<!-- what doe this do? -->
					<input type="hidden" name="newEmployee" value="newEmployee">
	
					<div>
						<div>
							<p>Name:<p>
							<input type="text" limit="255" name="name">
						</div>	
						
						<div>
							<p>Title:</p>
							<input type="text" limit="255" name="title">
						</div>	
						
						<div>
							<p>Seniority:</p>
							<input type="Number" min="0" step="1" value="0" name="yearsOfEmployment">
						</div>
						
						<br/>		
						<input id="submitButton" type="submit" value="Add Employee">
					</div>
				</form>
			</div>
		</div>
	</body>
</html>