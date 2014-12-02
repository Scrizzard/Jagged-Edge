window.onload = function(){
		$("#accordion").accordion();
		displayTables();
		populateDDLs();
};

function displayTables(){
	
	$.ajax({
    	type: 'GET',
    	url: 'fetch_passengers.php', 
    	success: function(result){
    		console.log(result);
			displayPassengerTable(result);
    		$("#accordion").accordion("refresh");			
    	}
    });

	$.ajax({  
    	type: 'GET',
    	url: 'fetch_tickets.php', 
    	success: function(result){
    	console.log(result);
    		displayTicketTable(result);
    		$("#accordion").accordion("refresh");
    	}
    });

	$.ajax({  
    	type: 'GET',
    	url: 'fetch_voyages.php', 
    	success: function(result){
    		console.log(result);
    		displayVoyageTable(result);
    		$("#accordion").accordion("refresh");
		}
    });
	
}

function displayPassengerTable(stringResult){
	    		
	console.log("parsing passenger");
	ele = $("#passengerTable");
	result = $.parseJSON(stringResult);
	ele.empty();
	
	//set up the table header and add it to our HTML page
	headerString = "<thead><tr><th>ID</th>" +
	"<th>Name</th>" +
	"<th>Nationality</th>" +
	"<th>Payment Type</th>" +
	"<th>Phone Number</th><th></th></tr></thead>";
		
	ele.append(headerString);
	ele.append("<tbody>");
	
	//set up the table body by adding an HTML row for each tuple in our query result
	for(i = 0; i < result.length; i++){
		rowString = "<tr>";
		rowString += "<td>" + result[i].passengerID + "</td>";
		rowString += "<td>" + result[i].name + "</td>";
		rowString += "<td>" + result[i].nationality + "</td>";
		rowString += "<td>" + result[i].paymentType + "</td>";
		rowString += "<td>" + result[i].phoneNumber + "</td>";
		rowString += "<td><button onclick=\"deletePassenger(" + result[i].passengerID + ")\">X</button></td>";
		rowString += "</tr>";
		ele.append(rowString);
	}

	ele.append("</tbody>");
}

function displayTicketTable(stringResult){
	    		
	console.log("parsing ticket");
	result = $.parseJSON(stringResult);
	ele = $("#ticketTable");
	ele.empty();
	
	//set up the table header and add it to our HTML page
	headerString = "<thead><tr><th>Ticket ID</th>" +
	"<th>Passenger ID</th>" +
	"<th>Voyage ID</th>" +
	"<th>Car ID</th>" +
	"<th>Passenger Name</th>" +
	"<th>Departure Station</th>" +
	"<th>Arrival Station</th>" +
	"<th>Departure Date</th>" +
	"<th>Departure Time</th>" +
	"<th>Cost</th></tr></thead>";
		
	ele.append(headerString);
	ele.append("<tbody>");
	
	//set up the table body by adding an HTML row for each tuple in our query result
	for(i = 0; i < result.length; i++){
		rowString = "<tr>";
		rowString += "<td>" + result[i].ticketID + "</td>";
		rowString += "<td>" + result[i].passengerID + "</td>";
		rowString += "<td>" + result[i].voyageID + "</td>";
		rowString += "<td>" + result[i].carID + "</td>";
		rowString += "<td>" + result[i].name + "</td>";
		rowString += "<td>" + result[i].stationOfOrigin + "</td>";
		rowString += "<td>" + result[i].terminalStation + "</td>";
		rowString += "<td>" + result[i].departureDate + "</td>";
		rowString += "<td>" + result[i].departureTime + "</td>";
		rowString += "<td>" + result[i].price + "</td>";
		rowString += "<td><button onclick=\"deleteTicket(" + result[i].id + ")\">X</button></td>";
		rowString += "</tr>";
		ele.append(rowString);
	}
	
	ele.append("</tbody>");
}

function displayVoyageTable(stringResult){

	console.log("parsing voyage");	    		
	result = $.parseJSON(stringResult);
	ele = $("#voyageTable");
	ele.empty();
	
	//set up the table header and add it to our HTML page
	headerString = "<thead><tr><th>Voyage ID</th>" +
	"<th>Route ID</th>" +
	"<th>Departure Date</th>" +
	"<th>Departure Time</th>" +
	"<th>Departure Station</th>" +
	"<th>Arrival Station</th></tr></thead>";

	ele.append(headerString);
	ele.append("<tbody>");
	
	//set up the table body by adding an HTML row for each tuple in our query result
	for(i = 0; i < result.length; i++){
		rowString = "<tr>";
		rowString += "<td>" + result[i].voyageID + "</td>";
		rowString += "<td>" + result[i].routeID + "</td>";
		rowString += "<td>" + result[i].departureDate + "</td>";
		rowString += "<td>" + result[i].departureTime + "</td>";
		rowString += "<td>" + result[i].stationOfOrigin + "</td>";
		rowString += "<td>" + result[i].terminalStation + "</td>";
		rowString += "</tr>";
		ele.append(rowString);
	}

	ele.append("</tbody>");
}

//TODO: reduce duplication by adding a parameter and combining these functions

function deletePassenger(id){
	data = {id : id};	

	$.ajax({  
    	type: 'GET',  
    	url: 'delete_passenger.php', 
    	data: data,
    	//if the query succeeded, display it using the showTable function defined below
    	success: function(result){
    		console.log(result);
    		displayTables();}
    });
}
    
function deleteTicket(id){
	data = {id : id};	

	$.ajax({  
    	type: 'GET',  
    	url: 'delete_ticket.php', 
    	data: data,
    	//if the query succeeded, display it using the showTable function defined below
    	success: function(result){
    		console.log(result);
    		displayTables();}
    });
}

function populateDDLs(){}
