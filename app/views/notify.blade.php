<script type="text/javascript">

	$(document).ready(function(){ 
		
		@if($alert = Session::get("alert"))
			new jBox('Notice', {
				content: '{{$alert[1]}}',
				color: '{{$alert[0]}}',
				autoClose: 2000
			});
		@endif
		
		@if($alert_valid = Session::get("alert_valid"))
			var validation_error_text = '';
					
			@foreach($alert_valid as $val)
				
				validation_error_text = validation_error_text + '{{$val[0]}}' + '<br />';
				
			@endforeach
			
			new jBox('Notice', {
				content: validation_error_text,
				color: 'yellow',
				autoClose: 5000
			});
		@endif
		
	});
	
</script>
	


