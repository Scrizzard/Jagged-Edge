<?php

include '../shared/db_connection.php';

$query = 
	"SELECT TrainRoute.routeID, stationOfOrigin, terminalStation, departureDate, departureTime, arrivalDate, arrivalTime, cost, seatNumber
	 FROM Passenger 
	 INNER JOIN PassengerTicket 
	 ON Passenger.id = PassengerTicket.passengerID
	 INNER JOIN TicketPrice
	 ON PassengerTicket.carID = TicketPrice.carID AND PassengerTicket.voyageID = TicketPrice.voyageID
	 INNER JOIN Voyage
	 ON PassengerTicket.voyageID = Voyage.id
	 INNER JOIN TrainRoute
	 ON Voyage.routeID = TrainRoute.routeID
	 WHERE name = \"" . $_GET["name"] . "\"";

$result = mysql_query($query);

if (!$result) {
	die('Invalid query: ' . mysql_error());
}

$rows = array();

while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    $rows[] = $row;
}

echo json_encode($rows);



?>