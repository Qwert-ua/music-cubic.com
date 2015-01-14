@extends('site.index')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-3">
			{{ View::make('site.blocks.title_user', array('user' => Auth::user())) }}
		</div>
		
		<div class="col-md-9">
		
			<blockquote>
				<p>{{trans('trans.title.artist')}}</p>
			</blockquote>
			
			{{ Form::open(array('url' => 'artist/save')) }}
			
				<div class="form-group">
					<label>{{trans('trans.form.name_artist')}}</label>
					{{ Form::text('name', null, array('class' => 'form-control')) }}
				</div>
				
				<div class="form-group">
	    			<label>{{trans('trans.form.year_foundation')}}</label> 
	    			{{ Form::selectYearRange('group_created', null, array('class' => 'form-control')) }}
	    		</div>
	    		
	    		<div class="form-group">
	    			<label>{{trans('trans.form.year_cessation_activity')}}</label> 
	    			{{ Form::selectYearRange('group_closed', null, array('class' => 'form-control')) }}
	    		</div>
	    		
	    		<div class="form-group">
	    			<label>{{trans('trans.form.genre')}}</label> 
	    			{{ Form::select('genre[]', $genre, null, array('class' => 'form-control', 'multiple' => 'multiple', 'data-live-search' => 'true')) }}
	    		</div>
	    		
	    		<div class="form-group">
	    			<label>{{trans('trans.form.country')}}</label>
	    			{{ Form::select('country', $country->lists('name', 'id'), null, array('class' => 'form-control', 'id' => 'country', 'data-live-search' => 'true')) }}
	    		</div>
	    		
	    		{{ Form::hidden('city_id', null, array('id' => 'city_id')) }}
	    		
	    		<div class="form-group">
	    			<label>{{trans('trans.form.city')}}</label>
	    			{{ Form::select('city', array(), NULL, array('class' => 'form-control', 'disabled' => 'true', 'id' => 'city', 'data-live-search' => 'true')) }}
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
	    			{{ Form::text('label', null, array('class' => 'form-control')) }}
	    		</div>
	    		
	    		<div class="form-group">
	    			<label>{{trans('trans.form.place_base')}}</label> 
	    			{{ Form::select('place_base', $country->lists('name', 'id'), null, array('class' => 'form-control', 'data-live-search' => 'true')) }}
	    		</div>
	    		
	    		<div class="form-group">
	    			<label>{{trans('trans.form.place_business')}}</label> 
	    			{{ Form::select('place_business', $country->lists('name', 'id'), null, array('class' => 'form-control', 'data-live-search' => 'true')) }}
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
	    		
				<button type="submit" class="btn btn-success btn-default btn-block">{{trans('trans.btn.save')}}</button>
			
			{{ Form::close() }}
					
		</div>
	</div>
</div>
	
@stop