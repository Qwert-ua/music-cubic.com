@extends('site.index')

@section('title_user')
	{{ View::make('site.blocks.title_user', array('user' => $user)) }}
@stop	
	
@section('content')

	<div class="col-md-9">
	
		<blockquote>
			<p>{{trans('trans.title.photogallery')}}</p>
		</blockquote>
		
		<h4>{{$album->name}} <br /><small>{{$album->description}}</small></h4>
		
		<br />
		
		<a href="/photo/editalbum/{{$album->id}}" class="btn btn-warning pull-right">Редактировать</a>
		
		<div class="clearfix"></div>
		
		<br />
		
		<div class="row" id="images_list" data-id="{{$album->id}}">
			{{ Photo::get_photos($album->id); }}
		</div>
		
	</div>

	
@stop