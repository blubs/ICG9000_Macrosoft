$(document).ready(function(){
	$('#inputData').val('');
	$('.side-menu-container > li').on('click', function(){
		$('.side-menu-container > li').removeClass('selected');	
		$(this).addClass('selected');
		$.ajax({
			url: ''
		});
	});
	
	$('#unpicked > li').on('click', function(){
		$('#unpicked li').removeClass('selected');	
		$(this).addClass('selected');
	});
	
	$('#add').on('click', function(){
		$li = $('#unpicked .selected');
		
		if(!$li.hasClass('missing-info')){
			if($('#picked :contains('+$li.text()+')').length == 0){
				$li.removeClass('selected');	
				$clone = $li.clone();
				$clone.attr('class', 'pickit-list-item');
				$('#picked').append($clone);	
				addToPrint($clone.text());
			}
		}
	});

	
	$('body').on('click','#picked > li', function(){
		$('#picked li').removeClass('selected');	
		$(this).addClass('selected');
	});
	
	$('#remove').on('click', function(){
		console.log("Remove: " + $('#picked .selected').text());
		removeFromPrint($('#picked .selected').text());
		$('#picked .selected').remove();
	});

	$('#add_all').on('click', function(){
		$children = $('#unpicked').children(':not(.missing-info)').clone();	
		$children.attr('class', 'pickit-list-item');
		$children.each(function(){
			if($('#picked :contains('+$(this).text()+')').length == 0){
				console.log($(this).text());
				$('#picked').append(this);	
				addToPrint($(this).text());
			}
		});
	});

	$('#remove_all').on('click', function(){
		$children = $('#picked').children();
		$children.remove();
		$('#inputData').val('');
	});

	function addToPrint(s){
		/* if($('#inputData').val() === ''){ */
		/* 	$('#inputData').val(s); */
		/* }else{ */
		/* 	$('#inputData').val($('#inputData').val() + '.' + s); */
		/* } */
		var string = $('#inputData').val();
		string += s + '.';
		$('#inputData').val(string);
		console.log($('#inputData').val());
	}
	function removeFromPrint(s){
		var string = $('#inputData').val();
		string = string.replace(s + '.', '');
		$('#inputData').val(string);
	}
	/* $('#pint').on('submit', function(){ */
	/* 	console.log($('#inputData').val()); */
	/* 	}); */
	/* $('#print').on('submit', function(){ */
	/* 	var contents = { */
	/* 		'Faculty': [] */
	/* 	}; */
	/* 	$('#picked').children().each(function(){ */
	/* 		contents.Faculty.push($(this).text()); */
	/* 	}); */
	/* 	console.log(JSON.stringify(contents)); */
	/* 	$.ajax({ */
	/* 		url: 'generate.php', */
	/* 		type: 'POST', */
	/* 		data: contents, */
	/* 		success: function(data){ */
	/* 			console.log("SUCESSS"); */	
	/* 			console.log(JSON.stringify(data)); */
	/* 		}, */
	/* 		error: function(){ */
	/* 			console.log("ERROR"); */	
	/* 			/1* console.log(JSON.stringify(data)); *1/ */
	/* 		} */
	/* 	}); */
	/* }); */
});
