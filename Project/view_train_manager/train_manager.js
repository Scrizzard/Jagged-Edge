
var table;

window.onload = function(){

	$("button, #return").button();
	table = $("#resultTable").DataTable({"bJQueryUI": true});

	populateDDL("dayDDL", 1, 32);
	populateDDL("monthDDL", 1, 13);
	populateDDL("yearDDL", 2014, 2020);
	populateDDL("hourDDL", 0, 24);
	populateDDL("minuteDDL", 0, 60);
	
	fetchVoyages();
	
	$.ajax({  
    	type: 'GET',  
    	url: 'fetch_routes.php', 
    	success: function(result){populateRoutes(result);}
    });
    
    $.ajax({
    	type: 'GET',
    	url: 'fetch_engine.php', 
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
	table.clear();

	//set up the table body by adding an HTML row for each tuple in our query result
	for(i = 0; i < result.length; i++){
		newRow = [result[i].routeID,
		result[i].stationOfOrigin,
		result[i].terminalStation,
		result[i].departureDate,
		result[i].departureTime,
		result[i].arrivalDate,
		result[i].arrivalTime,
		result[i].cost,
		"<button onclick=\"deleteVoyage(" + result[i].id + ")\">X</button>"];

		console.log(newRow);
		table.row.add(newRow);
	}
	table.draw();
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