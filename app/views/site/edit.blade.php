@extends('site.index')

@section('title_user')
	{{ View::make('site.blocks.title_user', array('user' => Auth::user())) }}
@stop		
	
@section('content')

	<div class="col-md-9">
		
		<blockquote>
			<p>Редактирование персональной информации</p>
		</blockquote>
		
		{{ Form::model($user) }}
		
			<div class="form-group">
				<label>Имя пользователя</label>
				{{ Form::text('username', null, array('class' => 'form-control')) }}
			</div>
			
			<div class="form-group">
				<label>Имя</label>
				{{ Form::text('firstname', null, array('class' => 'form-control')) }}
			</div>
			
			<div class="form-group">
				<label>Фамилия</label>
				{{ Form::text('lastname', null, array('class' => 'form-control')) }}
			</div>
			
			<div class="form-group">
				<label>День рождения</label>
				{{ Form::text('birthday', null, array('class' => 'form-control')) }}
			</div>
			
			<div class="form-group">
				<label>E-mail</label>
				{{ Form::text('email', null, array('class' => 'form-control')) }}
			</div>
			
			<hr />
			
			<div class="form-group">
				<label>Пароль</label>
				{{ Form::password('name', array('class' => 'form-control')) }}
			</div>
			
			<div class="form-group">
				<label>Подтверждение пароля</label>
				{{ Form::password('name', array('class' => 'form-control')) }}
			</div>
			
			<button type="submit" class="btn btn-success">Обновить информацию</button>
		
		{{ Form::close() }}
		
	</div>
	
@stop