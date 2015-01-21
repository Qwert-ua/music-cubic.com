@extends('site.index')

@section('content')

	@include('site.blocks.artist_top')
	
	
	
	{{ Form::open(array('url' => 'artist/save/' . array_get($artist, 'id', 0))) }}
	
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				@include('site.blocks.artist_left')
			</div>
		
			<div class="col-md-9">
			
				<blockquote>
					<p>{{ array_get($artist, 'name', trans('trans.title.artist')) }}</p>
				</blockquote>
				
				<div class="form-group">
					<label>{{trans('trans.form.name_artist')}}</label>
					{{ Form::text('name', array_get($artist, 'name'), array('class' => 'form-control')) }}
				</div>
				
				<div class="form-group">
	    			<label>{{trans('trans.form.year_foundation')}}</label> 
	    			{{ Form::selectYearRange('group_created', array_get($artist, 'group_created'), array('class' => 'form-control')) }}
	    		</div>
	    		
	    		<div class="form-group">
	    			<label>{{trans('trans.form.year_cessation_activity')}}</label> 
	    			{{ Form::selectYearRange('group_closed', array_get($artist, 'group_closed'), array('class' => 'form-control')) }}
	    		</div>
	    		
	    		<div class="form-group">
	    			<label>{{trans('trans.form.genre')}}</label> 
	    			{{ Form::select('genre[]', $genre, unserialize(array_get($artist, 'genre')), array('class' => 'form-control', 'multiple' => 'multiple', 'data-live-search' => 'true')) }}
	    		</div>
	    		
	    		<div class="form-group">
	    			<label>{{trans('trans.form.country')}}</label>
	    			{{ Form::text('country', null, ['class' => 'form-control geobasecountry']) }}
	    		</div>
	    		
	    		<div class="form-group">
	    			<label>{{trans('trans.form.city')}}</label>
	    			{{ Form::text('city', null, ['class' => 'form-control geobasecity', 'disabled' => 'disabled']) }}
	    		</div>
	    		
	    		<hr />
	    		
	    		<div class="control-group">
					<label class="control-label">{{trans('trans.form.structure')}}</label>
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
	    			<label>{{trans('trans.form.label')}}</label> 
	    			{{ Form::text('label', array_get($artist, 'label'), array('class' => 'form-control')) }}
	    		</div>
	    		
	    		<div class="form-group">
	    			<label>{{trans('trans.form.place_base')}}</label> 
	    			{{ Form::text('place_base', null, ['class' => 'form-control geobasecountry']) }}
	    		</div>
	    		
	    		<div class="form-group">
	    			<label>{{trans('trans.form.place_business')}}</label> 
	    			{{ Form::text('place_business', null, ['class' => 'form-control geobasecountry']) }}
	    		</div>
	    		
	    		<hr />
	    		
	    		<div class="control-group">
					<label class="control-label">{{trans('trans.form.links')}}</label>
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
	    		
				<div class="btn-group btn-group-justified">
					<div class="btn-group">
						<a href="/artist/{{array_get($artist, 'login')}}" class="btn btn-default">{{trans('trans.btn.back')}}</a>
					</div>
					<div class="btn-group">
						<button type="submit" class="btn btn-success btn-default">{{trans('trans.btn.save')}}</button>
					</div>
				</div>
						
			</div>
		</div>
	</div>
	
	{{ Form::close() }}
	
@stop