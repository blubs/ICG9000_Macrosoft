$(document).ready(function(){
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
			
			if($('#picked :contains('+$li.text()+')').length == 0){
				$li.removeClass('selected');	
				$clone = $li.clone();
				$clone.attr('class', 'picked-list-item');
				$('#picked').append($clone);	
			}
		});

		
		$('body').on('click','#picked > li', function(){
			$('#picked li').removeClass('selected');	
			$(this).addClass('selected');
		});
		
		$('#remove').on('click', function(){
			$('#picked .selected').remove();
		});

		$('#add_all').on('click', function(){
			$children = $('#unpicked').children().clone();	
			$children.removeClass();
			$('#picked').append($children);
		});

		$('#remove_all').on('click', function(){
			$children = $('#picked').children();
			$children.remove();
		});
});
