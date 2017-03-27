$(document).ready(function(){
	var queryFile = 'query.php';
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
});
