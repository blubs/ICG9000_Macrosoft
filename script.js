$(document).ready(function(){
	$('#inputData').val('');

	$('.account-tab:not("#change-password-tab")').addClass('not-active');

	$('body').on('click','#side-bar > .account-side-bar-item > .account-delete', function(){
		/* console.log($(this).parent().find('#account-user').text()); */	

		var contents = {
			'username': $(this).parent().find('#account-user').text()
		}

		$element = $(this);
		$.ajax({
			url: 'update-user.php',
			type: 'post',
			dataType: 'json',
			data: contents,
			success: function(data){
				$element.parent().remove();
			},
			error: function(){
				console.log("ERROR");	
			}
		});
	});

	$('#user-change-password').on('click', function(){
			if($('#change-password-new').val() == $('#change-password-new-retyped').val()){

				var contents = {
					'username': $('#side-bar > .account-side-bar-item > .selected').text(),
					'password': $('#change-password-new').val(),
				}

				$.ajax({
					url: 'update-user-change-password.php',
					type: 'post',
					dataType: 'json',
					data: contents,
					success: function(data){
						if(data.hasOwnProperty('error')){
							$('#failure').text(data.error);
							$('#failure').css('display', 'initial');
						}else{
							$('#failure').css('display', 'none');
							$('#success').css('display', 'initial');
							$('#success').fadeOut(5000, function(){
								$('#success').css('display', 'none');
							});
						}
					},
					error: function(data){
						$('#failure').text('ERROR');
						$('#failure').css('display', 'initial');
						$('#failure').fadeOut(5000, function(){
							$('#failure').css('display', 'none');
						});
					}
				})
			}else{
				$('#failure').text("Passwords do not match");
				$('#failure').css('display', 'initial');
				$('#failure').fadeOut(5000, function(){
					$('#failure').css('display', 'none');
				});
			}
	});

	$('#create-user-button').on('click', function(){
			if($('#user-password').val() == $('#user-retyped-password').val()){
				var contents = {
					'username':$('#user-username').val(),
					'password':$('#user-password').val()
				}

				$.ajax({
					url: 'update-user-add-user.php',
					type: 'post',
					dataType: 'json',
					data: contents,
					success: function(data){
						if(data.hasOwnProperty('error')){
							$('#failure').text(data.error);
							$('#failure').css('display', 'initial');
						}else{
							$('#failure').css('display', 'none');
							$('#success').css('display', 'initial');
							$('#success').fadeOut(5000, function(){
								$('#success').css('display', 'none');
							});
							$user = "<div class='account-side-bar-item'>";
							$user += "<div id='account-user' class='side-bar-item'>" + $('#user-username').val() + "</div>";
							$user += "<div class='account-delete'>&times;</div>";
							$user += "</div>";
							$('#side-bar').append($user);
						}
					},
					error: function(){
						$('#failure').text('ERROR');
						$('#failure').css('display', 'initial');
						$('#failure').fadeOut(5000, function(){
							$('#failure').css('display', 'none');
						});
					}
				});
			}else{
				$('#failure').text("Passwords do not match");
				$('#failure').css('display', 'initial');
				$('#failure').fadeOut(5000, function(){
					$('#failure').css('display', 'none');
				});
			}
	});

	$('body').on('click','#side-bar > .account-side-bar-item > .side-bar-item', function(){
		$('#side-bar > .account-side-bar-item > .side-bar-item').removeClass('selected');
		$(this).addClass('selected');
	});

	$('.account-tab').on('click', function(){
		$('.account-tab').addClass('not-active');
		$(this).removeClass('not-active');

		if($(this).text() == 'Change Password'){
			$('.account-tab-section').css('display', 'none');
			$('#change-password').css('display', 'flex');
		}else if($(this).text() == 'Add User'){
			$('.account-tab-section').css('display', 'none');
			$('#add-user').css('display', 'flex');
		}
	});

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
