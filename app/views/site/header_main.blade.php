<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			   
			<a class="navbar-brand" href="/"><img src="/images/logo.png" /></a>
		</div>
   
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<form class="navbar-form navbar-left" role="search">
					<div class="form-group inner-addon right-addon">
						<i class="glyphicon glyphicon-search text-muted"></i>
						<input type="text" class="form-control input-search-top" placeholder="Поиск">
					</div>
				</form>
			</ul>
            @include('site/blocks/header_player')
			<ul class="nav navbar-nav navbar-right">
        		<li><a href="/artist" data-toggle="tooltip" data-placement="bottom" title="{{trans('trans.menu.artist')}}"><span class="fa fa-star"></span></a></li>
        		<li><a href="/audio" data-toggle="tooltip" data-placement="bottom" title="{{trans('trans.menu.music')}}"><span class="fa fa-music"></span></a></li>
        		<li><a href="/photo" data-toggle="tooltip" data-placement="bottom" title="{{trans('trans.menu.photo')}}"><span class="fa fa-picture-o"></span></a></li>
				<li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><span class="glyphicon glyphicon-volume-up"></span></a></li>
				<li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><span class="glyphicon glyphicon-random"></span></a></li>
				<li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><span class="glyphicon glyphicon-list-alt"></span></a></li>
				<li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><span class="glyphicon glyphicon-camera"></span></a></li>
				<li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><span class="glyphicon glyphicon-cog"></span></a></li>
				<li><a href="/auth/logout" data-toggle="tooltip" data-placement="bottom" title="{{trans('trans.menu.logout')}}"><span class="glyphicon glyphicon-log-out"></span></a></li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</div>

