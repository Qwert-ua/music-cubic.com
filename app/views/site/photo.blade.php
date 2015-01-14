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
			
			<div class="btn-group pull-right">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-cr-alb">Создать альбом</button>
			</div>
			
			<div class="clearfix"></div>
			
			<br />
			
			<div class="row">
				
				@foreach($albums as $val_album)
				
					<div class="col-xs-3">
						<a href="/photo/album/{{ $val_album->id }}" class="thumbnail">
							<img src="{{ Photo::get_first($val_album->id) }}" alt="{{$val_album->name}}">
							
							<div class="photo-name">
								<b>{{$val_album->name}}</b>
								<br />
								<small>{{$val_album->description}}</small>
							</div>
						</a>
					</div>
				
				@endforeach
	
	  		</div>
			
		</div>
		
		<!-- Modal --> 
		
		<div class="modal fade" tabindex="-1" role="dialog" id="modal-cr-alb">
			<div class="modal-dialog">
				<div class="modal-content">
				
				{{ Form::open(array('url' => 'photo/save')) }}
					
					<div class="modal-header bg-primary">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="exampleModalLabel">Новый альбом</h4>
					</div>
					
					<div class="modal-body">
						
						<div class="form-group">
							<label>Название</label>
							{{ Form::text('name', null, array('class' => 'form-control')) }}
						</div>
						
						<div class="form-group">
							<label>Описание</label>
							{{ Form::textarea('description', null, array('class' => 'form-control', 'rows' => '6')) }}
						</div>
						
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-success">Save</button>
					</div>
				
				{{ Form::close() }}
					
				</div>
			</div>
		</div>
	</div>	
</div>
@stop