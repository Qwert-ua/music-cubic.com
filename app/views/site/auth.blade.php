@extends('site.index')
	
@section('content')
	    	
	<div class="row">
		<div class="col-md-offset-4 col-md-4 col-md-offset-4 auth"> 
		
			<div class="text-center">
				<h3>{{ trans('trans.title.auth') }}</h3>
			</div>
	
			<br>
		
			{{ Form::open(array('url' => '/auth/login')) }}
			
				<div class="form-group">
					{{ Form::text('email', NULL, array('class' => 'form-control', 'placeholder' => 'E-mail')) }}
				</div>
					
				<div class="form-group">
					{{ Form::password('password', array('class' => 'form-control', 'placeholder' => trans('trans.form.password'))) }}
				</div>
				
				<div class="form-group">
					<label>
						{{ Form::checkbox('remember') }} {{ trans('trans.form.member') }}
					</label>
				</div>
					
				<div class="btn-group">
					<button type="submit" class="btn btn-default btn-primary">{{ trans('trans.btn.login') }}</button>
					<a href="/registration" class="btn btn-default">{{ trans('trans.btn.register') }}</a>
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
