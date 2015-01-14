@extends('site.index')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-3">
			{{ View::make('site.blocks.title_user', array('user' => Auth::user())) }}
		</div>
		
		<div class="col-md-9">
			
			<blockquote>
				<p>{{ trans('trans.title.edit_pers_data') }}</p>
			</blockquote>
			
			{{ Form::model($user) }}
			
				<div class="form-group">
					<label>{{ trans('trans.form.username') }}</label>
					{{ Form::text('username', null, array('class' => 'form-control')) }}
				</div>
				
				<div class="form-group">
					<label>{{ trans('trans.form.first_name') }}</label>
					{{ Form::text('firstname', null, array('class' => 'form-control')) }}
				</div>
				
				<div class="form-group">
					<label>{{ trans('trans.form.last_name') }}</label>
					{{ Form::text('lastname', null, array('class' => 'form-control')) }}
				</div>
				
				<div class="form-group">
					<label>{{ trans('trans.form.birthday') }}</label>
					{{ Form::text('birthday', NULL, array('class' => 'form-control datepicker_birthday')) }}
				</div>
				
				<div class="form-group">
					<label>{{ trans('trans.form.addrress') }}</label>
					{{ Form::text('address', null, array('class' => 'form-control')) }}
				</div>
				
				<div class="form-group">
					<label>E-mail</label>
					{{ Form::text('email', null, array('class' => 'form-control')) }}
				</div>
				
				<hr />
				
				<div class="form-group">
					<label>{{ trans('trans.form.password') }}</label>
					{{ Form::password('password', array('class' => 'form-control')) }}
				</div>
				
				<div class="form-group">
					<label>{{ trans('trans.form.confirm_password') }}</label>
					{{ Form::password('confirm_password', array('class' => 'form-control')) }}
				</div>
				
				<button type="submit" class="btn btn-success">{{ trans('trans.btn.update_pers_info') }}</button>
			
			{{ Form::close() }}
			
		</div>
	</div>	
</div>
@stop