$(document).on('change', '.btn-file :file', function() {
	var input = $(this),
	numFiles = input.get(0).files ? input.get(0).files.length : 1,
    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
	input.trigger('fileselect', [numFiles, label]);
});

$(document).ready(function(){
	
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
    	//$('select').selectpicker('mobile');
	}
	
	$.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });
    
    $('.thumbnail-look').hover(function(){
    	$(this).find('.look').fadeIn(100);
    },function(){
    	$(this).find('.look').fadeOut(100);
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
		size: 10,
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
	
	$(".sort_images").sortable({ 
		timeout: 500,
	    placeholder: 'col-xs-2 col-md-3 placeholder',
        scroll: false,
        tolerance: 'intersect',
        over: function(event, ui) {
	        $(".placeholder").height($(".sortable-item").height() - 1);
	    },
	    update: function( event, ui ) {
		
			var sort = new Array();
			
			$(".sort_images div.sortable-item").each(function(i) {
				sort[i] = $(this).attr('data-id');
			});
			
			$.ajax({
				type: 'post',
				url: '/ajax/images_sort',
				async: true,
				cache: false,
				data: { 'sort': sort },
			});
			
		}
	});
    $( ".sort_images" ).disableSelection();
    
    SelectCity();
	
	$('#country').change(function() {
		$('#city').find('option').remove();
		$('#city_id').val('0')
		SelectCity();		
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
		
		//$('#city').append('<option value="0">-</option>');
		
		$.each(data, function (index, value) {
			$('#city').append('<option value="' + value.id + '">' + value.name + '</option>');
		});
		
		$('#city').removeAttr('disabled');
		$('#city').selectpicker('refresh');
		$('#city').selectpicker('val', $('#city_id').val());
	});
	
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
}

function ajax_gallery()
{
	$.ajax({
    	type: 'post',
		url: '/ajax/getgallery',
		data: {'id':$('#images_list').attr('data-id')},
		async: true,
		cache: false,
		success: function(data) {
			$('#images_list').html(data);
			
			new jBox('Notice', {
				content: 'Загрузка завершена',
				color: 'green',
				autoClose: 2000
			});
		}
    });
}

function ajax_imgdel(album, img)
{
	$.ajax({
		type: 'post',
		url: '/ajax/imgdel',
		async: true,
		cache: false,
		dataType: 'json',
		data: { 'album':album, 'img':img },
		success: function(data) {
			
			$.ajax({
		    	type: 'post',
				url: '/ajax/getgallery',
				data: {'id':album},
				async: true,
				cache: false,
				success: function(data) {
					$('#images_list').html(data);
				}
		    });
			
			new jBox('Notice', {
				content: data.status.text,
				color: data.status.color,
				autoClose: 1000
			});
			
		}
	});
	
	
}


