<html>
	<body>
		<?php
		
			//connect to a DB (your DB name is probably not "fish")
			mysql_connect("localhost", "root", "");
			mysql_select_db("tms");
		
			$result = mysql_query($_POST["query"]);

			//result will be false for a bad query
			if (!$result) { // add this check.
				die('Invalid query: ' . mysql_error());
			}

			echo "<span>your query: </span>";
			echo $_POST["query"];
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
		
		<a href="test.html">
			<button>go back</button>
		</a>
	</body>
</html>