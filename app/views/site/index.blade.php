<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Music Kubik</title>

		<link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="/assets/bootstrap/css/non-responsive.css" rel="stylesheet">
		<link href="/assets/jBox/jBox.css" rel="stylesheet">
		<link href="/assets/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet">
		<link href="/assets/bootstrap-select-master/css/bootstrap-select.min.css" rel="stylesheet">
		<link href="/assets/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
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
	    	@yield('content')
		</div>
	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="/assets/jBox/jBox.min.js"></script>
		<script src="/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="/assets/bootstrap-datepicker/js/locales/bootstrap-datepicker.ru.js"></script>
		<script src="/assets/bootstrap-select-master/js/bootstrap-select.min.js"></script>
		<script src="/assets/js/site.js"></script>
	</body>
</html>