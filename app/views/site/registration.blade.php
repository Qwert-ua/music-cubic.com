@extends('site.index')
	
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-4 col-md-4 col-md-offset-4 auth"> 
		
			<div class="text-center">
				<h3>Регистрация</h3>
			</div>
	
			<br>
		
			{{ Form::open(array('url' => 'registration/send')) }}
			
				<div class="form-group">
					{{ Form::text('email', array_get($post, 'email'), array('class' => 'form-control', 'placeholder' => 'E-mail')) }}
				</div>
				
				<div class="form-group">
					{{ Form::text('username', array_get($post, 'username'), array('class' => 'form-control', 'placeholder' => 'Имя пользователя')) }}
				</div>
				
				<div class="form-group">
					{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Пароль')) }}
				</div>
				
				<div class="form-group">
					{{ Form::password('confirm_password', array('class' => 'form-control', 'placeholder' => 'Подтверждение пароля')) }}
				</div>
					
				<div class="btn-group">
					<button type="submit" class="btn btn-default btn-primary">Зарегистрироваться</button>
					<a href="/" class="btn btn-default">Войти</a>
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
</div>	
@stop		    	
