@extends('admin.index')
	
@section('content')
    <div class="row">
	    <div class="col-md-12">
	    	
	    	<div class="panel panel-default">
				<div class="panel-heading">
			        <h3 class="panel-title">
				    	<span class="text-muted"> 
				    	@if($id > 0)
				    		{{ array_get($user, 'firstname') }}  {{ array_get($user, 'lastname') }}
				    		
				    		@if(array_get($user, 'active') == 1)
				    			<small class="text-success">актив</small>
				    		@else
				    			 <small class="text-danger">блок</small>
				    		@endif
				    	@else
				    		Новый пользователь
				    	@endif
				    </h3>
			    </div>
	    	
		    	<div class="panel-body">
		    		
		    		{{ Form::open(array('url' => 'admin/users/save/' . $id)) }}
		    		
			    		<div class="form-group">
			    			<label>Имя пользователя</label>
			    			{{ Form::text('username', array_get($user, 'username'), array('class' => 'form-control')) }}
			    		</div>
			    		
			    		<div class="form-group">
			    			<label>Имя</label>
			    			{{ Form::text('firstname', array_get($user, 'firstname'), array('class' => 'form-control')) }}
			    		</div>
			    		
			    		<div class="form-group">
			    			<label>Фамилия</label>
			    			{{ Form::text('lastname', array_get($user, 'lastname'), array('class' => 'form-control')) }}
			    		</div>
			    		
			    		<div class="form-group">
			    			<label>E-mail</label>
			    			{{ Form::text('email', array_get($user, 'email'), array('class' => 'form-control')) }}
			    		</div>
			    		
			    		<div class="form-group">
			    			<label>Страна</label>
			    			{{ Form::select('country', array(), array_get($user, 'country'), array('class' => 'form-control selectpicker', 'id' => 'country', 'data-live-search' => 'true')) }}
			    		</div>
			    		
			    		{{ Form::hidden('city_id', array_get($user, 'city_id'), array('id' => 'city_id')) }}
			    		
			    		<div class="form-group">
			    			<label>Город</label>
			    			{{ Form::select('city', array(), array_get($user, 'city'), array('class' => 'form-control selectpicker', 'disabled' => 'true')) }}
			    		</div>
			    		
			    		<div class="form-group">
			    			<label>Адрес</label>
			    			{{ Form::text('address', array_get($user, 'address'), array('class' => 'form-control', 'rows' => '6')) }}
			    		</div>
			    		
			    		<div class="form-group">
			    			<label>День рождения</label>
			    			{{ Form::text('birthday', array_get($user, 'birthday'), array('class' => 'form-control birth_datepicker', 'id' => 'birth_date')) }}
			    		</div>
			    		
			    		<div class="form-group">
			    			<label>Пароль</label>
			    			{{ Form::password('password', array('class' => 'form-control')) }}
			    		</div>
			    		
			    		<div class="form-group">
			    			<label>Подтверждение пароля</label>
			    			{{ Form::password('confirm_password', array('class' => 'form-control')) }}
			    		</div>
			    		
			    		<div class="form-group">
							<label class="control-label">Роль</label>
							@foreach($roles as $role)
								<label>{{ Form::checkbox('roles[]', $role->id, User::chk_role($id, $role->id)) }}</label> {{ $role->description }}
							@endforeach
						</div>
						
						<button type="submit" class="btn btn-success">Сохранить</button>
		    		
		    		{{ Form::close() }}
		    		
		    	</div>
			</div>
			
	    </div>
    </div>
@stop	