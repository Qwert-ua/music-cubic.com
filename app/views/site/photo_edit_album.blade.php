@extends('site.index')
	
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-3">
			{{ View::make('site.blocks.title_user', array('user' => Auth::user())) }}
		</div>
		
		<div class="col-md-9">
		
			<blockquote>
				<p>{{trans('trans.title.photogallery')}}</p>
			</blockquote>
			
			{{ Form::model($album, array('url'=>'photo/save/' . $album->id)) }}
				
				
				<div class="form-group">
					<label>Название</label>
					{{ Form::text('name', NULL, array('class' => 'form-control')) }}
				</div>
				
				<div class="form-group">
					<label>Описание</label>
					{{ Form::text('description', NULL, array('class' => 'form-control', 'rows' => '6')) }}
				</div>
				
				<div class="row">
					<div class="col-xs-8">
						<button class="btn btn-success btn-block" type="submit">Сохранить</button>
					</div>
					
					<div class="col-xs-2">
						<a href="/photo/album/{{$album->id}}" class="btn btn-warning btn-block">Зкрыть</a>
					</div>
					
					<div class="col-xs-2">
						<a href="/photo/delalbum/{{$album->id}}" class="btn btn-danger btn-block" onclick="return confirm('Удалить ?')">Удалить</a>
					</div>
				</div>
				
			{{ Form::close() }}
			
			<hr />
			
			<label>Фото</label>
			
			{{ Form::open(array('url'=>'ajax/uploadphoto/' . $album->id, 'id'=>'upload', 'files'=>true)) }}
			
				<div id="drop" class="text-center">
					Drop Here or
						<br />
					<a class="btn btn-block btn-default">Browse</a>
					<input type="file" name="images" multiple />
				</div>
		
				<ul>
					
				</ul>
			
			{{ Form::close() }}
			
			<div class="row sort_images" id="images_list" data-id="{{$album->id}}">
				{{ Photo::get_photos($album->id, true) }}
			</div>
			
		</div>
	</div>
</div>
@stop