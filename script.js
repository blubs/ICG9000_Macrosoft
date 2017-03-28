$(document).ready(function(){
	var queryFile = 'query_professors.php';
	var generateCardsFile = 'query_cards.php';
	console.log("Is this working");
	$.ajax({
		url: queryFile,
		dataType: 'json',
		type:'get',
		success: function(data){
			console.log("SUCCESS");
			console.log("data.result: " + JSON.stringify(data.result));	
			$.each(data.result, function(i, data){	
				$('#list').append('<option>'+data+'</option>'); 			
			});
		},
		error: function(data){
			console.log("ERROR");
		}
	});
	$('#generate').on('click', function(e){
		$.ajax({
			url: generateCardsFile,
			dataType: 'json',
			type: 'get',
			success: function(data){
				console.log("GENERATE");
				$('#result').append('<tr><th>Class_NUMBER</th><th>Course</th><th>Sec</th><th>Course Title</th></tr>');
				/* console.log("Data: " + JSON.stringify(data)); */
				$.each(data, function(i, dataRow){
					/* console.log("datarow: " + JSON.stringify(dataRow)); */
					var row = '<tr>';
					$.each(dataRow, function(j, dataCol){
							/* console.log("dataCol: " + dataCol); */
						row += '<td>'+dataCol+'</td>';	
					});
					row += '</tr>';
					$('#result').append(row);
				});
			},
			error: function(data){
				console.log("Cannot Generate");
			}
		});
	});
});
