<html>
	<header>
		<script type="text/javascript" src="../shared/jQuery/external/jquery/jquery.js"></script>
		<script type="text/javascript" src="../shared/jQuery/jquery-ui.js"></script>
		<script type="text/javascript">window.onload = function(){ $("#return, button").button();};</script>

		
		<link href="../shared/jQuery/jquery-ui.css" type="text/css" rel="stylesheet">
		<link href="../shared/jQuery/jquery-ui.structure.css" type="text/css" rel="stylesheet">
		<link href="../shared/jQuery/jquery-ui.theme.css" type="text/css" rel="stylesheet">
		<link href="../shared/style.css" type="text/css" rel="stylesheet">
		<link type="../text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto">
	</header>
	
	<body>
		<a id="return" href="..">Return to Index</a>
		<div id="displayTableWrapper">
			<?php
			
				include '../shared/db_connection.php';
				
				$result = mysql_query($_POST["query"]);
	
				//result will be false for a bad query
				if (!$result) { // add this check.
					die('Invalid query: ' . mysql_error());
				}
	
				echo "<p id='queryHeader'>Your Query: <br/>";
				echo "<p id='queryString'>" . $_POST["query"] . "</p>";
				echo "<br/>";
				
				//query was not a selection and result need not be printed
				if (!is_resource($result)){
					echo "<p>Query completed successfully</p>";
				}
				
				//result is a set of tuples and must be printed
			    else{
					while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {	
						foreach($row as &$entry){
							echo $entry . "&nbsp";
						}
						echo "<br/>";
					}
				}
			?>

		</div>
		
		<br/>
		<a href="super.html">
			<button>
				New Query
			</button> 
		</a>
	
	</body>
</html>