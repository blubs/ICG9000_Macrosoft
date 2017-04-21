$(document).ready(function(){
	$('#inputData').val('');

	/* $('#account-table-row > #account-table-delete').on('click', function(){ */
	/* 	console.log($(this).parent().find('#account-user').text()); */	
	/* 	var contents = { */
	/* 		'user': $(this).parent().find('#account-user').text() */
	/* 	} */

	/* 	/1* $.ajax({ *1/ */
	/* 	/1* 	url: 'update-professor.php', *1/ */
	/* 	/1* 	type: 'post', *1/ */
	/* 	/1* 	dataType: 'json', *1/ */
	/* 	/1* 	data: contents, *1/ */
	/* 	/1* 	success: function(){ *1/ */
	/* 	/1* 		console.log("SUCCESS"); *1/ */	
	/* 	/1* 	}, *1/ */
	/* 	/1* 	error: function(){ *1/ */
	/* 	/1* 		console.log("SUCCESS"); *1/ */	
	/* 	/1* 	} *1/ */
	/* 	}); */
	/* }); */

	$('#update-button').on('click', function(){
			var contents = {
				'faculty': $('#side-bar .selected').text(),
				'office_hours': $('#edit-office-hours').val(),
				'phone':$('#edit-phone').val(),
				'email':$('#edit-email').val(),
				'room':$('#edit-room').val()
			}; 	
			/* console.log(JSON.stringify(contents)); */
			$.ajax({
				url: 'update-professor.php',
				type: 'post',
				dataType: 'json',
				data: contents,
				success: function(data){
					/* console.log("SUCCESS: update-post"); */
					/* console.log(JSON.stringify(data)); */
					$('#success').css('display', 'initial');
					$('#success').fadeOut(5000, function(){
						$('#success').css('display', 'none');
					});
					if($('#edit-room').val() !== '' &&
						 $('#edit-office-hours').val() !== '' &&
						 ($('#edit-phone').val() !== '' ||
							$('#edit-email').val() !== '')){
						$('#side-bar > .selected').removeClass('missing-info');
					}
				},
				error: function(data){
					$('#failure').css('display', 'initial');
					$('#failure').fadeOut(5000, function(){
						$('#failure').css('display', 'none');
					});
				}
			});
	});

	$('#side-bar > .side-bar-item').on('click', function(){
		$('#side-bar > .side-bar-item').removeClass('selected');
		$(this).addClass('selected');
		
		var contents = {
			'faculty': $(this).text()
		}
		$.ajax({
			url: 'update-professor.php',
			type: 'get',
			dataType: 'json',
			data: contents,
			success: function(data){
				$('#edit-office-hours').val(data.office_hours);
				$('#edit-phone').val(data.phone);
				$('#edit-email').val(data.email);
				$('#edit-room').val(data.room);
			},
			error: function(data){
				console.log('error');
			}
		});
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

	
	$('body').on('click','.pickit-list-item', function(){
		$(this).parent().children().removeClass('selected');
		$(this).addClass('selected');
	});
	
	$('#remove').on('click', function(){
		console.log("Remove: " + $('#picked .selected').text());
		removeFromPrint($('#picked .selected').text());
		$('#picked .selected').remove();
	});

	$('#add_all').on('click', function(){
		$children = $('#unpicked').children(':not(.missing-info, .pickit-list-title)').clone();	
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
		$children = $('#picked').children(':not(.pickit-list-title)');
		$children.remove();
		$('#inputData').val('');
	});

	function addToPrint(s){
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
});
