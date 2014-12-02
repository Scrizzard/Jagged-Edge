//TODO: get cars in here somehow

window.onload = function(){

	populateDDL("dayDDL", 1, 32);
	populateDDL("monthDDL", 1, 13);
	populateDDL("yearDDL", 2014, 2020);
	populateDDL("hourDDL", 0, 24);
	populateDDL("minuteDDL", 0, 60);
	
	fetchVoyages();
	
	$.ajax({  
    	type: 'GET',  
    	url: 'scheduler_routes.php', 
    	success: function(result){populateRoutes(result);}
    });
    
    $.ajax({  
    	type: 'GET',
    	url: 'scheduler_engine.php', 
    	success: function(result){populateEngines(result);}
    });
};

function fetchVoyages(){
	$.ajax({  
    	type: 'GET',  
    	url: 'fetch_voyages.php', 
    	//if the query succeeded, display it using the showTable function defined below
    	success: function(result){showTable(result);}
    });	
}

function showTable(stringResult){
	//parse the result we got from the PHP file into a JSON object for easy access
	result = $.parseJSON(stringResult);
	$("#resultTableBody").empty();
	
	//set up the table header and add it to our HTML page
	headerString = "<tr><th>Route ID</th>" +
	"<th>Start Station</th>" +
	"<th>End Station</th>" +
	"<th>Departure Date</th>" +
	"<th>Departure Time</th>" +
	"<th>Arrival Date</th>" +
	"<th>Arrival Time</th>" +
	"<th>Cost</th>" +
	"<th>Delete</th>";
	
	$("#resultTableHead").html(headerString);

	//set up the table body by adding an HTML row for each tuple in our query result
	for(i = 0; i < result.length; i++){
		rowString = "<tr>";
		rowString += "<td>" + result[i].routeID + "</td>";
		rowString += "<td>" + result[i].stationOfOrigin + "</td>";
		rowString += "<td>" + result[i].terminalStation + "</td>";
		rowString += "<td>" + result[i].departureDate + "</td>";
		rowString += "<td>" + result[i].departureTime + "</td>";
		rowString += "<td>" + result[i].arrivalDate + "</td>";
		rowString += "<td>" + result[i].arrivalTime + "</td>";
		rowString += "<td>$" + result[i].cost + "</td>";
		rowString += "<td><button onclick=\"deleteVoyage(" + result[i].id + ")\">X</button></td>";
		rowString += "</tr>";
		$("#resultTableBody").append(rowString);
	}
}

function populateRoutes(stringResult){
	result = $.parseJSON(stringResult);

	for(i = 0; i < result.length; i++){
		//Weakness here: station of origin and terminal station should be sanitized
		entryString = result[i].routeID + ": " + result[i].stationOfOrigin + " to " + result[i].terminalStation;
		entryString = "<option value=\"" + result[i].routeID + "\">" + entryString + "</option>";
		$("#routeDDL").append(entryString);
	}
}

function populateEngines(stringResult){
	result = $.parseJSON(stringResult);

	for(i = 0; i < result.length; i++){
		//Weakness here: station of origin and terminal station should be sanitized
		entryString = result[i].id + ": " + result[i].name;
		entryString = '<option value=\"' + result[i].id + '"">' + entryString + '</option>';
		$("#engineDDL").append(entryString);
	}
}

function populateDDL(eleName, lowerBound, upperBound){
	ele = $("#" + eleName);
	for(i = lowerBound; i < upperBound; i++){
		optionString = '<option value="' + i + '">' + i + '</option>';
		ele.append(optionString);
	}
}

function submitInsertQuery(){
	data = {day : $("#dayDDL").val(), 
			month : $("#monthDDL").val(),
			year : $("#yearDDL").val(),
			hour : $("#hourDDL").val(),
			minute : $("#minuteDDL").val(),
			route : $("#routeDDL").val(),
			engine : $("#engineDDL").val()};
			
	$.ajax({  
    	type: 'GET',
    	url: 'scheduler_insert.php', 
    	data: data,
    	success: function(result){
    		fetchVoyages();
    		console.log(result);
    	}
    });
}	

function deleteVoyage(id){
	data = {id : id};	

	$.ajax({  
    	type: 'GET',  
    	url: 'delete_voyage.php', 
    	data: data,
    	//if the query succeeded, display it using the showTable function defined below
    	success: function(result){
    		console.log(result);
    		fetchVoyages();}
    });

	//request the ticket information from the database via an AJAX call
}