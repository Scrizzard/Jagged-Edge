var voyageTable;
var passengerTable;
var ticketTable;


window.onload = function(){
		$("#accordion").accordion({heightStyle: "content"});
		$("#return").button();
		fetchPassengers();
		fetchTickets();
		fetchVoyages();
		populateDDLs();
		passengerTable = $("#passengerTable").DataTable({"bJQueryUI": true});
		ticketTable = $("#ticketTable").DataTable({"bJQueryUI": true});
		voyageTable = $("#voyageTable").DataTable({"bJQueryUI": true});
};

function fetchPassengers(){
		
	$.ajax({
    	type: 'GET',
    	url: 'fetch_passengers.php', 
    	success: function(result){
    		console.log("passenger fetch\n" + result);
			displayPassengerTable(result);
    		$("#accordion").accordion("refresh");			
    	}
    });
}

function fetchTickets(){

	$.ajax({  
    	type: 'GET',
    	url: 'fetch_tickets.php', 
    	success: function(result){
    	console.log("ticket fetch\n" + result);
    		displayTicketTable(result);
    		$("#accordion").accordion("refresh");
    	}
    });
}

function fetchVoyages(){

	$.ajax({  
    	type: 'GET',
    	url: 'fetch_voyages.php', 
    	success: function(result){
    		console.log("voyage fetch\n" + result);
    		displayVoyageTable(result);
    		$("#accordion").accordion("refresh");
		}
    });
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
    		console.log("passenger delete\n" + result);
    		fetchPassengers();
    		fetchTickets();
    	}
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
    		console.log("ticket delete\n" + result);
			fetchTickets();
		}
    });
}

function displayPassengerTable(stringResult){
	    		
	result = $.parseJSON(stringResult);
	passengerTable.clear();
		
	//set up the table header and add it to our HTML page
	
	//set up the table body by adding an HTML row for each tuple in our query result
	for(i = 0; i < result.length; i++){

		newRow = [result[i].passengerID,
			result[i].name,
			result[i].nationality,
			result[i].paymentType,
			result[i].phoneNumber,
			"<button onclick=\"deletePassenger(" + result[i].passengerID + ")\">X</button>"];

		passengerTable.row.add(newRow);
	}

	passengerTable.draw();
}

function displayTicketTable(stringResult){
	    		
	result = $.parseJSON(stringResult);
	ticketTable.clear();
	
	for(i = 0; i < result.length; i++){
		
		newRow = [result[i].id, 
			result[i].passengerID,
			result[i].voyageID, 
			result[i].carID,
			result[i].name, 
			result[i].stationOfOrigin, 
			result[i].terminalStation, 
			result[i].departureDate, 
			result[i].departureTime, 
			result[i].price, 
			"<button onclick=\"deleteTicket(" + result[i].id + ")\">X</button>"];
	
		ticketTable.row.add(newRow);
 	}
	
	ticketTable.draw();
}

function displayVoyageTable(stringResult){

	result = $.parseJSON(stringResult);
	voyageTable.clear();

	//set up the table body by adding an HTML row for each tuple in our query result
	for(i = 0; i < result.length; i++){
		newRow = [
			result[i].voyageID,
			result[i].routeID,
			result[i].departureDate,
			result[i].departureTime,
			result[i].stationOfOrigin,
			result[i].terminalStation];

		voyageTable.row.add(newRow);
	}
	
	voyageTable.draw();
}

function populateDDLs(){}
