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
			
			if(!$li.hasClass('missing-info')){
				if($('#picked :contains('+$li.text()+')').length == 0){
					$li.removeClass('selected');	
					$clone = $li.clone();
					$clone.attr('class', 'pickit-list-item');
					$('#picked').append($clone);	
				}
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
			$children = $('#unpicked').children(':not(.missing-info)').clone();	
			$children.attr('class', 'pickit-list-item');
			$children.each(function(){
				if($('#picked :contains('+$(this).text()+')').length == 0){
					console.log($(this).text());
					$('#picked').append(this);	
				}
			});
		});

		$('#remove_all').on('click', function(){
			$children = $('#picked').children();
			$children.remove();
		});

});
