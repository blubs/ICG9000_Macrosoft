$(document).ready(function(){
		$('.side-menu-container > li').on('click', function(){
			$('.side-menu-container > li').removeClass('selected');	
			$(this).addClass('selected');
			$.ajax({
				url: ''
			});
		});
		
		$('#unpicked > li').on('click', function(){
			$('.pickit-list > li').removeClass('selected');	
			$(this).addClass('selected');
		});
		
		$('#add').on('click', function(){
			$li = $('#unpicked .selected');
			
			if($('#picked :contains('+$li.text()+')').length == 0){
				$li.removeClass('selected');	
				$('#picked').append($li.clone());	
			}
		});
});
