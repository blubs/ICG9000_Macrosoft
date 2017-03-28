$(document).ready(function(){
	var page = 1;
	var limit = 10;
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
		getList(0, limit);
	});
	$('#next-page').on('click', function(e){
		page++;
		getList((page-1)*limit, limit);
	});
	function getList(offset, limit){	
		$.ajax({
			url: generateCardsFile,
			dataType: 'json',
			data: {offset: offset, limit: limit},
			type: 'POST',
			success: function(data){
				console.log("GENERATE");
				console.log("data: " + JSON.stringify(data));
				$('#result tr').remove();
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
				console.log("data: " + JSON.stringify(data));
			}
		});
	}
});
