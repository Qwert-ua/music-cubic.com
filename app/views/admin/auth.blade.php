<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="_token" content="{{ csrf_token() }}" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>QWERT CMS</title>

		<!-- Bootstrap -->
		<link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		
		<!-- JBox -->
		<link href="/assets/jBox/jBox.css" rel="stylesheet">
		
		<!-- Custom -->
		<link href="/assets/css/auth.css" rel="stylesheet">

		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
  	</head>
  
  	<body>
    	
    	<div class="container">
	    	
	    	<div class="text-center">
		    	<h3>QWERT <small>cms</small></h3>
	    	</div>
	    	
	    	{{ Form::open([ 'url' => '/admin/auth/login' ]) }}
	    	
				<div class="form-group">
					<input type="text" name="username" class="form-control" placeholder="Имя пользователя">
  				</div>
  				
  				<div class="form-group">
					<input type="password" name="password" class="form-control" placeholder="Пароль">
  				</div>
  				
  				<button type="submit" class="btn btn-default btn-enter">Войти</button>
			
			{{ Form::close() }}
	    	
    	</div>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="/assets/jquery-ui-1.11.2/external/jquery/jquery.js"></script>
		
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
		
		<!-- JBox -->
		<script src="/assets/jBox/jBox.min.js"></script>
		
		<!-- Custom -->
		<script src="/assets/js/auth.js"></script>
		
  	</body>
</html>