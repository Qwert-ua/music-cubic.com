$(document).ready(function(){ 
	
	$('.btn-audio-play').on('click', function(){
		
		$('i.control-audio-play').fadeIn(500);
		$(this).find('i.control-audio-play').fadeOut(500);
		
		$('i.control-audio-pause').fadeOut(500);
		$(this).find('i.control-audio-pause').fadeIn(500).removeClass('hide');
		
		$('#audio-player').attr('src', '/uploads/music/' + $(this).attr('data-track'));
		$('#audio-player').trigger("play");
	});
	
});