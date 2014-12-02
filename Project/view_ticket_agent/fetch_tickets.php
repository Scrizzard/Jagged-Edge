<?php

mysql_connect("localhost", "root", "");
mysql_select_db("tms");

$query = 
	"SELECT TicketPrice.voyageID, passengerID, name, TicketPrice.carID, price, PassengerTicket.id AS ticketID, seatNumber, departureDate, departureTime, stationOfOrigin, terminalStation
	 FROM TicketPrice
	 JOIN PassengerTicket
	 ON TicketPrice.voyageID = PassengerTicket.voyageID AND TicketPrice.carID = TicketPrice.carID
	 JOIN Voyage
	 ON Voyage.id = PassengerTicket.voyageID
	 JOIN TrainRoute
	 ON Voyage.id = TrainRoute.routeID
	 JOIN Passenger
	 ON PassengerTicket.passengerID = Passenger.id";

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