$(document).ready(function(){ 
	
	$.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });
    
    $('#userForm').bootstrapValidator();
	
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
    
    new jBox('Confirm', {
	    confirmButton: 'Да',
	    cancelButton: 'Нет'
	});
	
	/*$('.block_user').on('click', function() {
		$('#modal_block_userid').val($(this).attr('data-id'));
	});*/
	
	/*$('a.ajax_send').on('click', function() {
	    
	    var post = $(this).attr('post');
	    
	    console.log(post);
	    
	    $.ajax({
	    	type: 'post',
			url: '/ajax/post',
			data: post,
			async: false,
			cache: false,
			success: function(data) {
				console.log(data)
			}
	    });
	    
	    return false;	
	});*/

	$('.birth_datepicker').datepicker({
		format: "dd M yyyy",
		startView: 2,
		language: "ru",
		autoclose: true
	});
	
	/*$('.datepicker').datepicker({
		format: "dd M yyyy",
		startView: 2,
		language: "ru",
		autoclose: true
	});*/
	
	$('.datepicker').datepicker({
		format: "yyyy-mm-dd",
		startView: 2,
		language: "ru",
		autoclose: true,
		forceParse: false,
	});
	
	$('.tooltip_top_menu').tooltip();
	//$('.tooltip').tooltip();
	
	$('select').selectpicker({
		size: 10
	});
	
	$('.selectpicker_city').selectpicker({
      	size: 5
	});
	
	SelectCity();
	
	$('#country').change(function() {
		$('#city').find('option').remove();
		$('#city_id').val('0')
		SelectCity();		
	});
	
	/*$('#add_to_group_composition').on('click', function() {
	    $('#new_group_composition').show().removeClass('hide');
	    $('#new_group_composition').append('<div class="form-group"><label for="group_composition" class="col-md-3 control-label">&nbsp</label><div class="col-md-3"><input type="text" name="group_composition" class="form-control" id="group_composition" value=""></div><div class="col-md-5"><input type="text" name="group_composition" class="form-control" id="group_composition" value=""></div><div class="col-md-1 control-label" style="padding-top: 0"><button type="button" class="btn btn-default tooltip_top_menu rem_from_group_composition" data-toggle="tooltip" data-placement="bottom" title="Удалить музыканта"><i class="fa fa-minus"></i></button></div></div>');
	});*/
	
	/*$('body').on('click', '.rem_from_group_composition', function() {
		 $("div.form-group").remove();
	});*/
	
	$(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();

		var controlForm = $('.controls1'),
            currentEntry = $(this).parents('.entry1:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
        controlForm.find('.entry1:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="glyphicon glyphicon-minus"></span>');
    }).on('click', '.btn-remove', function(e)
    {
		$(this).parents('.entry1:first').remove();

		e.preventDefault();
		return false;
	});
	
	$(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();

		var controlForm = $('.controls2'),
            currentEntry = $(this).parents('.entry2:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
        controlForm.find('.entry2:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="glyphicon glyphicon-minus"></span>');
    }).on('click', '.btn-remove', function(e)
    {
		$(this).parents('.entry2:first').remove();

		e.preventDefault();
		return false;
	});

});


function SelectCity() {
	
	var country_id = $('#country').val();
	if(!country_id || country_id == 0) return false;
	
	$.ajax({
		url: "/ajax/selectcity",
		type: "POST",
		async: true,
		data: { country_id: $('#country').val()},
		cache: false
	}).done(function(result) {
		
		var data = JSON.parse(result);
		
		$('#city').append('<option value="0">-</option>');
		
		$.each(data, function (index, value) {
			$('#city').append('<option value="' + value.id + '">' + value.name + '</option>');
		});
		
		$('#city').removeAttr('disabled');
		$('#city').selectpicker('refresh');
		$('#city').selectpicker('val', $('#city_id').val());
	});
	
}