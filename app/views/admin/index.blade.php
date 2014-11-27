<!DOCTYPE html>
<html lang="en">
	<head>
  
	  	<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <title>Music Kubik - CMS</title>
	
	    <!-- Bootstrap -->
	    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	    <link href="/assets/bootstrap/css/non-responsive.css" rel="stylesheet">
	    
	    <!-- Datepicker -->
	    <link href="/assets/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet">
	
		<!-- bootstrapvalidator -->
		<link href="/assets/bootstrapvalidator/css/bootstrapValidator.min.css" rel="stylesheet">
		
		<!-- bootstrap-modal -->
		<link href="/assets/bootstrap-modal-master/css/bootstrap-modal-bs3patch.css" rel="stylesheet">
		<link href="/assets/bootstrap-modal-master/css/bootstrap-modal.css" rel="stylesheet">
		
		<!-- bootstrap-select -->
		<link href="/assets/bootstrap-select-master/css/bootstrap-select.min.css" rel="stylesheet">
		
		<!-- Icon fontawesome -->
		<link href="/assets/icons/fontawesome/css/font-awesome.min.css" rel="stylesheet">

		<!-- jBox Notify -->
		<link href="/assets/jBox/jBox.css" rel="stylesheet">
		
		<!-- custom -->
		<link href="/assets/css/admin.css" rel="stylesheet">
			
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
  
	</head>
	<body>

		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
					  <span class="icon-bar"></span>
					  <span class="icon-bar"></span>
					</button>
					  
					<a class="navbar-brand" href="/admin">Music Kubik CMS</a>
	        
				</div>
	        
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav hide">
						<form class="navbar-form navbar-left" role="search">
							<div class="form-group">
								<input type="text" class="form-control input-sm" placeholder="Search">
							</div>
							<button type="submit" class="btn btn-sm btn-default">Search</button>
						</form>
					</ul>
	        
			        <ul class="nav navbar-nav navbar-right">
			        	<li><a href="/admin/users" class="tooltip_top_menu" data-toggle="tooltip" data-placement="bottom" title="Пользователи"><span class="glyphicon glyphicon-user"></span></a></li>
			        	<li><a href="/admin/complaints" class="tooltip_top_menu" data-toggle="tooltip" data-placement="bottom" title="Жалобы и заблокированые пользователи"><span class="glyphicon glyphicon-eye-close"></span></a></li>
						<li><a href="/admin/artists" class="tooltip_top_menu" data-toggle="tooltip" data-placement="bottom" title="Исполнители"><span class="glyphicon glyphicon-star"></span></a></li>
			          <li><a href="/admin/legal" class="tooltip_top_menu" data-toggle="tooltip" data-placement="bottom" title="Правовые&nbsp;споры"><span class="glyphicon glyphicon-certificate"></span></a></li>
			          <li><a href="/admin/audio" class="tooltip_top_menu" data-toggle="tooltip" data-placement="bottom" title="Аудио&nbsp;файлы"><span class="glyphicon glyphicon-music"></span></a></li>
			          <li><a href="/admin/poster" class="tooltip_top_menu" data-toggle="tooltip" data-placement="bottom" title="Афиша"><span class="glyphicon glyphicon-calendar"></span></a></li>
			          <li><a href="/admin/statistics" class="tooltip_top_menu" data-toggle="tooltip" data-placement="bottom" title="Статистика"><span class="glyphicon glyphicon-cog"></span></a></li>
			          <li><a href="/admin/auth/logout" class="tooltip_top_menu" data-toggle="tooltip" data-placement="bottom" title="Выход"><span class="glyphicon glyphicon-log-out"></span></a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	    
		<div class="container">
	  	
	    	@yield('content')
	    			
		</div>
		
		<!--modal-->
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		  
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
	  
		<!-- Datepicker -->
		<script src="/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="/assets/bootstrap-datepicker/js/locales/bootstrap-datepicker.ru.js"></script>
	  
		<!-- bootstrapvalidator -->
		<script src="/assets/bootstrapvalidator/js/bootstrapValidator.min.js"></script>
		
		<!-- bootstrap-modal -->
		<script src="/assets/bootstrap-modal-master/js/bootstrap-modalmanager.js"></script>
		<script src="/assets/bootstrap-modal-master/js/bootstrap-modal.js"></script>
		
		<!-- bootstrap-select -->
		<script src="/assets/bootstrap-select-master/js/bootstrap-select.min.js"></script>
		<script src="/assets/bootstrap-select-master/js/i18n/defaults-ru_RU.min.js"></script>
		
		<!-- jBox Notify -->
		<script src="/assets/jBox/jBox.min.js"></script>
		
		<!-- Custom -->
		<script src="/assets/js/admin.js"></script>
  
	</body>
</html>