$(document).ready(function(){ 
	
	$.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });
	
	$.ajax({
    	type: 'post',
		url: '/ajax/notify',
		async: false,
		cache: false,
		dataType: 'json',
		success: function(data) {
		
			if(data) 
			{
				if(data.alert_valid)
				{
					var validation_error_text = '';
					
					$.each(data.alert_valid, function (index, value) {
						 validation_error_text = validation_error_text + value + '<br />';
					});
					
					new jBox('Notice', {
						content: validation_error_text,
						color: 'yellow',
						autoClose: 5000
					});
				}
				
				if(data.alert)
				{
					new jBox('Notice', {
						content: data.alert[1],
						color: data.alert[0],
						autoClose: 2000
					});
				}
			}
		}
    });

    $('[data-toggle="tooltip"]').tooltip();

    $('.datepicker_birthday').datepicker({
		format: "yyyy-mm-dd",
		startView: 2,
		language: "ru",
		autoclose: true,
		forceParse: false,
	});
    
    new jBox('Confirm', {
	    confirmButton: 'Да',
	    cancelButton: 'Нет'
	});
	
	$('select').selectpicker({
		size: 10
	});
	
	$('select.select_artist').on('change', function(){
	    //var selected = $('.select_artist option:selected').val();
		//alert(selected);
		
		$('.hide_select').removeAttr('disabled');
		$('select').selectpicker('refresh');
 	});
});


