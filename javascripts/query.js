$(function(){

	//Filters map for easing the process of distinguish them
	var filters = {"All" : 0, "Spanish":1, "French": 2, "Over100":3, "Under100": 4};
	var table = "";

	init();

	//Initialization function for the table and the first filter. By default it displays all the books
	function init(){
		initTable();
		filterTable(filters["All"]);
	}

	//Teh DataTable plugin sets up the parameters for the table display
	function initTable(){
		table = $('#dataTable').DataTable( {
			columns: [
			{ title: "Id" },
			{ title: "Title" },
			{ title: "Author" },
			{ title: "Country" },
			{ title: "Language" },
			{ title: "Price" },
			{ title: "Quantity" }],
			"paging":   false,
			"info":     false,
			"order": [[ 1, "desc" ]],
			"scrollY": "300px",
			"scrollX": true,
			"scrollCollapse": true,
		} );
	}

	//Filters a table based on a filter index which is processed in the facade controller.
	//Ajax implemented in order to enhance the user XP
	function filterTable(filter){
		$.post("controller/facade.php", {
			filter: filter
		}, function(data) {
			if (data===1) {
				swal("All books are gone!", "Please upload books.xml again", "success");
				updateTableData([]);
			}else{
				var formattedData = formatData(data);
				updateTableData(formattedData);
			}
		}, "json");
	}

	//The data coming from the DataBase is formatted to be successfully displayed in the table
	//This method returns a list of the value for each row, removing the regarding keys
	function formatData(data){
		var formattedData=[];
		for (var i = 0; i < data.length; i++) {
			var row = data[i];
			var formattedRow = [];	
			for (var column in row){
				formattedRow.push(row[column]);
			}
			formattedData.push(formattedRow);
		}
		return formattedData;
	}

	//This method clears the datatable information and re-renders it with new data
	function updateTableData(data){
		table.clear();
		table.rows.add(data).draw();
	}

	//Event trigger in order to make the table optimized for mobile displays.
	$(window).resize(function () {
		var viewportWidth = $(window).width();
		if (viewportWidth < 992) {
			$("#dataTable").addClass("compact");
		}
		if (viewportWidth >= 992) {
			$("#dataTable").removeClass("compact");
		}
	});

	//Button events to filter the different queries
	$("#allBooks").click(function(){
		filterTable(0);
	});
	$("#spanishBooks").click(function(){
		filterTable(1);
	});
	$("#frenchBooks").click(function(){
		filterTable(2);
	});
	$("#priceOver100").click(function(){
		filterTable(3);
	});
	$("#priceUnder100").click(function(){
		filterTable(4);
	});
	$("#erase").click(function(){
		filterTable(5);
	});
});