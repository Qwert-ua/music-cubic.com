@extends('admin.index')
	
@section('content')
    <div class="row">
	    <div class="col-md-12">
	    	
	    	<div class="panel panel-default">
				<div class="panel-heading">
			        <h3 class="panel-title">
				    	<span class="text-muted"> 
				    	@if($id > 0)
				    		{{ array_get($artists, 'name') }}
				    		
				    		@if(array_get($artists, 'active') == 1)
				    			<small class="text-success">актив</small>
				    		@else
				    			 <small class="text-danger">блок</small>
				    		@endif
				    	@else
				    		Новый исполнитель
				    	@endif
				    </h3>
			    </div>
	    	
		    	<div class="panel-body">
		    		
		    		{{ Form::open(array('url' => 'admin/artists/save/' . $id)) }}
		    		
			    		<div class="form-group">
			    			<label>Название исполнителя</label>
			    			{{ Form::text('name', array_get($artists, 'name'), array('class' => 'form-control')) }}
			    		</div>
			    		
			    		<div class="form-group">
			    			<label>Контакты администраторов</label> 
			    			{{ Form::select('admins[]', $users->lists('username', 'id'), unserialize(array_get($artists, 'admins')), array('class' => 'form-control', 'multiple' => 'multiple', 'data-live-search' => 'true')) }}
			    		</div>
			    		
			    		@if($id > 0)
				    		<div class="form-group">
				    			<label>Дата регистрации страницы в системе</label> 
				    			{{ $artists->created_at }}
				    		</div>
				    		
				    		<div class="form-group">
				    			<label>Время последней активности администраторов</label> 
				    		</div>
			    		@endif
			    		
			    		<div class="form-group">
			    			<label>Год основания</label> 
			    			{{ Form::text('group_created', array_get($artists, 'group_created'), array('class' => 'form-control datepicker')) }}
			    		</div>
			    		
			    		<div class="form-group">
			    			<label>Год прекращения деятельности</label> 
			    			{{ Form::text('group_closed', array_get($artists, 'group_closed'), array('class' => 'form-control datepicker')) }}
			    		</div>
			    		
			    		<div class="form-group">
			    			<label>Жанр исполнения</label> 
			    			{{ Form::select('genre[]', $genre, unserialize(array_get($artists, 'genre')), array('class' => 'form-control', 'multiple' => 'multiple', 'data-live-search' => 'true')) }}
			    		</div>
			    		
			    		<div class="form-group">
			    			<label>Страна</label>
			    			{{ Form::select('country', array('0' => '') + $country->lists('name', 'id'), array_get($artists, 'country'), array('class' => 'form-control', 'id' => 'country', 'data-live-search' => 'true')) }}
			    		</div>
			    		
			    		{{ Form::hidden('city_id', array_get($artists, 'city'), array('id' => 'city_id')) }}
			    		
			    		<div class="form-group">
			    			<label>Город</label>
			    			{{ Form::select('city', array(), NULL, array('class' => 'form-control', 'disabled' => 'true', 'id' => 'city', 'data-live-search' => 'true')) }}
			    		</div>
			    		
			    		<hr />
			    		
			    		<div class="control-group">
							<label class="control-label">Состав</label>
							
							@if($id > 0)
								@foreach(unserialize(array_get($artists, 'group_composition')) as $val_group_composition)
									<div class="entry1 input-group">
										{{ Form::text('group_composition[]', $val_group_composition, array('class' => 'form-control')) }}
										<span class="input-group-btn">
											<button class="btn btn-danger btn-remove" type="button">
												<span class="glyphicon glyphicon-minus"></span>
											</button>
										</span>
									</div>
								@endforeach
							@endif
							
							<div class="controls1"> 
								<div class="entry1 input-group">
									{{ Form::text('group_composition[]', NULL, array('class' => 'form-control')) }}
									<span class="input-group-btn">
										<button class="btn btn-success btn-add" type="button">
											<span class="glyphicon glyphicon-plus"></span>
										</button>
									</span>
								</div>
							</div>
						</div>
			    		
			    		<hr />
			    		
			    		<div class="form-group">
			    			<label>Лейбл</label> 
			    			{{ Form::text('label', array_get($artists, 'label'), array('class' => 'form-control')) }}
			    		</div>
			    		
			    		<div class="form-group">
			    			<label>Место основания</label> 
			    			{{ Form::select('place_base', array('0' => '') + $country->lists('name', 'id'), array_get($artists, 'place_base'), array('class' => 'form-control', 'data-live-search' => 'true')) }}
			    		</div>
			    		
			    		<div class="form-group">
			    			<label>Место деятельности</label> 
			    			{{ Form::select('place_business', array('0' => '') + $country->lists('name', 'id'), array_get($artists, 'place_business'), array('class' => 'form-control', 'data-live-search' => 'true')) }}
			    		</div>
			    		
			    		<hr />
			    		
			    		<div class="control-group">
							<label class="control-label">Ссылки на аккаунты и ресурсы</label>
							
							@if($id > 0)
								@foreach(unserialize(array_get($artists, 'links')) as $val_links)
									<div class="entry2 input-group">
										{{ Form::text('links[]', $val_links, array('class' => 'form-control')) }}
										<span class="input-group-btn">
											<button class="btn btn-danger btn-remove" type="button">
												<span class="glyphicon glyphicon-minus"></span>
											</button>
										</span>
									</div>
								@endforeach
							@endif
							
							<div class="controls2"> 
								<div class="entry2 input-group">
									{{ Form::text('links[]', NULL, array('class' => 'form-control')) }}
									<span class="input-group-btn">
										<button class="btn btn-success btn-add" type="button">
											<span class="glyphicon glyphicon-plus"></span>
										</button>
									</span>
								</div>
							</div>
						</div>
			    		
			    		<hr />
						
						<button type="submit" class="btn btn-success">Сохранить</button>
		    		
		    		{{ Form::close() }}
		    		
		    	</div>
			</div>
			
	    </div>
    </div>
@stop	