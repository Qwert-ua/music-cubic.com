$(document).on('change', '.btn-file :file', function() {
	var input = $(this),
	numFiles = input.get(0).files ? input.get(0).files.length : 1,
    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
	input.trigger('fileselect', [numFiles, label]);
});

$(document).ready(function(){ 
	
	$.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });
    
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
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
	    
	    if($('.select_artist option:selected').val() == 0)
		{
			$('.hide_select').prop('disabled', true);
			$('select').selectpicker('refresh');
			$('.btn-file').addClass('active');
		}
		else
		{
			$('.hide_select').removeProp('disabled');
			$('select').selectpicker('refresh');
			$('.btn-file').removeClass('active');
		}
		
 	});
 	
 	function centerModal() {
    	$(this).css('display', 'block');
		var $dialog = $(this).find(".modal-dialog");
		var offset = ($(window).height() - $dialog.height()) / 4;
		// Center modal vertically in window
		$dialog.css("margin-top", offset);
	}

	$('.modal').on('show.bs.modal', centerModal);
	$(window).on("resize", function () {
    	$('.modal:visible').each(centerModal);
	});
});


