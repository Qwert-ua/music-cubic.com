@extends('site.index')
	
@section('content')
	    	
	<div class="row">
		<div class="col-md-offset-4 col-md-4 col-md-offset-4 auth"> 
		
			<div class="text-center">
				<h3>Авторизация</h3>
			</div>
	
			<br>
		
			<form role="form" method="post" action="/auth/login">
				<div class="form-group">
					<input type="text" name="email" class="form-control" placeholder="E-mail">
				</div>
					
				<div class="form-group">
					<input type="password" name="password" class="form-control" placeholder="Пароль">
				</div>
					
				<div class="btn-group">
					<button type="submit" class="btn btn-default btn-primary">Войти</button>
					<a href="/registration" class="btn btn-default">Регистрация</a>
				</div>
			</form> 
			
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
