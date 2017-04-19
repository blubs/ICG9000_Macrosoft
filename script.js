$(document).ready(function(){
	$('#inputData').val('');

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
