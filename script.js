$(document).ready(function(){
	/* All  the variables that will be used */
	var page = 1;
	var limit = 10;
	var queryFile = 'query_professors.php';
	var generateCardsFile = 'query_cards.php';
	/* Test */
	console.log("Is this working");

	/* This will automatically be run when the DOM loads up and add the professors to the select tag */
	$.ajax({
		url: queryFile,
		dataType: 'json',
		type:'get',
		success: function(data){
			/* Tests */
			console.log("SUCCESS");
			console.log("data.result: " + JSON.stringify(data.result));	
			/* Go through each of the professors and append it to the select tag */
			$.each(data.result, function(i, data){	
				/* The actual appending */
				$('#list').append('<option>'+data+'</option>'); 			
			});
		},
		error: function(data){
			console.log("ERROR");
		}
	});


	/* Add functionality to the generate button */
	$('#generate').on('click', function(e){
		getList(0, limit);
	});
	

	/* Add functionality to the next-page button */
	$('#next-page').on('click', function(e){
		page++;
		getList((page-1)*limit, limit);
	});
	
	/* Sends a post request to the php to get appropriate data to fill the table */
	function getList(offset, limit){	
		$.ajax({
			url: generateCardsFile,
			dataType: 'json',
			/* I make the data JSON object here, might want to change this */
			data: {offset: offset, limit: limit, Faculty: $('#list').find(':selected').text()},
			type: 'POST',
			success: function(data){
				/* Tests */
				console.log("GENERATE");
				console.log("data: " + JSON.stringify(data));

				/* Removes all the rows from the table in case this call has happened already */
				$('#result tr').remove();

				/* Appends the headers again to the table */
				$('#result').append('<tr><th>Class_NUMBER</th><th>Course</th><th>Sec</th><th>Course Title</th></tr>');

				/* Goes througha ll the rows of the data retrieved */
				/* console.log("Data: " + JSON.stringify(data)); */
				$.each(data, function(i, dataRow){
					/* console.log("datarow: " + JSON.stringify(dataRow)); */
					var row = '<tr>';
					/* Goes through the colums */
					$.each(dataRow, function(j, dataCol){
							/* console.log("dataCol: " + dataCol); */
						row += '<td>'+dataCol+'</td>';	
					});
					row += '</tr>';
					/* Appends the string row to the table */
					$('#result').append(row);
				});
			},
			error: function(data){
				console.log("Cannot Generate");
				console.log("data: " + JSON.stringify(data));
			}
		});
	}
});
