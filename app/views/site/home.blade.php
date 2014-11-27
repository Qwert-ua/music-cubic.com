@extends('site.index')

@section('title_user')
	{{ View::make('site.blocks.title_user', array('user' => Auth::user())) }}
@stop	
	
@section('content')
	
	<div class="col-md-9">
		<blockquote>
			<p>Events</p>
		</blockquote>
			
		<form role="form">
			
			<div class="col-md-4">
				<div class="col-xs-6 col-md-12">
			    	<div class="form-group">
						<div class="col-xs-16  col-md-12">
							<input type='text' name="in" class="form-control datepicker text-left" value="" />
						</div>
					</div>
					
					<p>&nbsp;</p>
					<div class="clearfix"></div>
				
					<a href="#" class="thumbnail"><img style="height: 190px;" src="http://placehold.it/190x215" alt="..."></a>
				</div>
			</div>
			  
			<div class="col-md-8">
				
				<div class="row">
					@for($i = 1; $i <= 6; $i++)
						<div class="col-xs-6 col-md-4">
							<a href="#" class="thumbnail"><img src="http://placehold.it/140x110" alt="..."></a>
						</div>
					@endfor
				</div>	
				
			</div>
		</form>
		<div class="clearfix"></div>
			  
		<blockquote>
			<p>Photo</p>
		</blockquote>
				  
		<div class="clearfix"></div>
		
		<ul class="nav nav-pills">
			<li class="active bg-warning"><a href="#">All</a></li>
			<li><a href="#">Hui</a></li>
		</ul>
		
		<p>&nbsp;</p>
		<div class="clearfix"></div>
		
		<div class="row">
			@for($i = 1; $i <= 8; $i++)
				<div class="col-xs-6 col-md-3">
					<a href="#" class="thumbnail"><img src="http://placehold.it/160x130" alt="..."></a>
				</div>
			@endfor
		</div>		  
		
		<p>&nbsp;</p>
		<div class="clearfix"></div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="well well-sm">
					<img class="pull-left" src="http://placehold.it/160x130" alt="...">
					
					<div class="media-right">
						<h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry</h3>
						<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia...</p>
					</div>
					
					<hr />
					  
					<span class="glyphicon glyphicon-user"></span> <a href="">Username</a> <span class="glyphicon glyphicon-comment"></span> <a href="">Comments</a> 
					<span class="glyphicon glyphicon-eye-open"></span> <a href="">Vievs</a> 
					<span class="glyphicon glyphicon-time"></span> <a href=""> Published 12.12.2012</a>
					<span class="glyphicon glyphicon glyphicon-bullhorn"></span> 
	
					<div class="clearfix"></div>
				</div>
			</div>
		</div>		  
	</div>

	
@stop