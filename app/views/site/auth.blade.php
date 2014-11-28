@extends('site.index')
	
@section('content')
	    	
	<div class="row">
		<div class="col-md-offset-4 col-md-4 col-md-offset-4 auth"> 
		
			<div class="text-center">
				<h3>Авторизация</h3>
			</div>
	
			<br>
		
			{{ Form::open(array('url' => '/auth/login')) }}
			
				<div class="form-group">
					{{ Form::text('email', NULL, array('class' => 'form-control', 'placeholder' => 'E-mail')) }}
				</div>
					
				<div class="form-group">
					{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Пароль')) }}
				</div>
				
				<div class="form-group">
					<label>
						{{ Form::checkbox('remember') }} Запомнить меня
					</label>
				</div>
					
				<div class="btn-group">
					<button type="submit" class="btn btn-default btn-primary">Войти</button>
					<a href="/registration" class="btn btn-default">Регистрация</a>
				</div>
			
			{{ Form::close() }}
			
		</div>
	</div>
	
	<br />
	<br />
	<br />
	
	<div class="row">
		<div class="col-md-12">
			<h1>Header</h1>
	
			<p>Text</p>
		</div>
	</div>
	
@stop		    	
