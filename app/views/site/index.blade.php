<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="_token" content="{{ csrf_token() }}" />
		<title>Music Kubik</title>

		<link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="/assets/bootstrap/css/non-responsive.css" rel="stylesheet">
		<link href="/assets/jBox/jBox.css" rel="stylesheet">
		<link href="/assets/eternicode-bootstrap-datepicker/css/datepicker3.css" rel="stylesheet">
		<link href="/assets/bootstrap-select-master/css/bootstrap-select.min.css" rel="stylesheet">
		<link href="/assets/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="/assets/ajax-file-upload-form/css/style.css" rel="stylesheet">
		<link href="/assets/css/site.css" rel="stylesheet">
		
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
	<body>
	
		@if(Auth::check())
			@if(Auth::user()->hasRole('login') === true && Auth::user()->hasActive() === true) 
				{{ View::make('site.header_main') }}
			@endif
		@else
			{{ View::make('site.header') }}
		@endif
	    
		<div class="container">
	    	<div class="row row-fluid col-md">
	    		@yield('title_user')
				@yield('content')
	    	</div>
		</div>
		
		<!-- Modal Content -->

		<div class="modal fade" id="UploadUserIcon">
			<div class="modal-dialog">
				<div class="modal-content">
					{{ Form::open(array('url' => 'uploadicon', 'files' => 'true')) }}
					
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span></button>
						<h4 class="modal-title">Загрузка аватарки</h4>
					</div>
					<div class="modal-body">
						
						{{ Form::file('image') }}
						
					</div>
					<div class="modal-footer">
		        		<button type="button" class="btn btn-default" data-dismiss="modal">Не хочу</button>
						<button type="submit" class="btn btn-primary">Загрузить</button>
					</div>
					
					{{ Form::close() }}
					
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	
		<script src="/assets/js/jquery-1.11.1.min.js"></script>
		<script src="/assets/jquery-ui-1.11.2/jquery-ui.js"></script>
		<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="/assets/eternicode-bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="/assets/eternicode-bootstrap-datepicker/js/locales/bootstrap-datepicker.ru.js"></script>
		<script src="/assets/bootstrap-select-master/js/bootstrap-select.min.js"></script>
		<script src="/assets/jBox/jBox.min.js"></script>
		<script src="/assets/ajax-file-upload-form/js/jquery.knob.js"></script>
		<script src="/assets/ajax-file-upload-form/js/jquery.ui.widget.js"></script>
		<script src="/assets/ajax-file-upload-form/js/jquery.iframe-transport.js"></script>
		<script src="/assets/ajax-file-upload-form/js/jquery.fileupload.js"></script>
		<script src="/assets/ajax-file-upload-form/js/script.js"></script>
		<script src="/assets/js/site.js"></script>
	</body>
</html>