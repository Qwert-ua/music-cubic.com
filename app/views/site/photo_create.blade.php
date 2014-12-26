@extends('site.index')

@section('title_user')
	{{ View::make('site.blocks.title_user', array('user' => Auth::user())) }}
@stop	
	
@section('content')
	
	<div class="col-md-9">
	
		<blockquote>
			<p>{{trans('trans.title.photogallery')}}</p>
		</blockquote>
		
		{{ Form::open(array('url'=>'photo/upload', 'id'=>'upload', 'files'=>true)) }}
			
			
			<div class="form-group">
				<label>Название Альбома</label>
				{{ Form::text('name', null, array('class' => 'form-control')) }}
			</div>
			
			<div id="drop">
				Drop Here or

				<a class="btn btn-default">Browse</a>
				<input type="file" name="upl" multiple />
			</div>

			<ul>
				<!-- The file uploads will be shown here -->
			</ul>
			
			
			<button class="btn btn-success" type="button">Сохранить</button>
			
		{{ Form::close() }}
		
	</div>

	
@stop