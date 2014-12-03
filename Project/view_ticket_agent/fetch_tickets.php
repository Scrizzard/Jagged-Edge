<?php

include '../shared/db_connection.php';

$query = 
	"SELECT TicketPrice.voyageID, passengerID, name, TicketPrice.carID, price, PassengerTicket.id, seatNumber, departureDate, departureTime, stationOfOrigin, terminalStation
	 FROM PassengerTicket
	 INNER JOIN Passenger
	 ON PassengerTicket.passengerID = Passenger.id
	 INNER JOIN TicketPrice
	 ON TicketPrice.voyageID = PassengerTicket.voyageID AND TicketPrice.carID = TicketPrice.carID
	 INNER JOIN Voyage
	 ON Voyage.id = PassengerTicket.voyageID
	 INNER JOIN TrainRoute
	 ON Voyage.id = TrainRoute.routeID";
	 
	 
	 
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