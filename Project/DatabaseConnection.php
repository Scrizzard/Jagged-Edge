<?php
	// Include this file in any php file that needs to access the database, 
	// rather than typing out the connection information in dozens of different
	// files

	// to use in your php files:
	// include '../DatabaseConnection.php';
	

	// the database connection
	// you may need to change this login information for your specific installation
	$SERVER = 'localhost';
	$USER = 'root';
	$PASSWORD = 'openSesame';
	$DATABASENAME = 'TMS';

	$DBC = mysql_connect($SERVER, $USER, $PASSWORD);
	mysql_select_db($DATABASENAME);

?>