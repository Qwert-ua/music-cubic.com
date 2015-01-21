@extends('site.index')	
	
@section('content')

	@include('site.blocks.artist_top')
	
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				@include('site.blocks.artist_left')
			</div>
		
			<div class="col-md-9">
			
				<blockquote>
					<p>{{ $artist->name }}</p>
				</blockquote>
				
				<div class="btn-group">
					<a href="/artist/{{ $artist->nickname }}/albums" class="btn btn-default">Список аудио альбомов</a>
					<button type="button" href="#" class="btn btn-default" data-toggle="modal" data-target="#UploadAudio">Загрузить аудио</button>
				</div>
				
				<br />
				<br />
				
				
				<img src="/uploads/artists/{{ $artist->nickname }}/audio/{{ $album->nickname }}/{{ $album->cover }}" style="width: 100px; margin-right: 20px"  class="img-circle pull-left" />
				<h2>{{ $album->name }}</h2>
				
				<br /><br /><br />
						
				List audio		
						
			</div>
		</div>	
	</div>
	
	<!-- Modal Content -->

	<div class="modal fade" id="UploadAudio">
		<div class="modal-dialog">
			<div class="modal-content">
			
				{{ Form::open(array('url' => 'artist/uploadaudio/' . $album->id, 'files' => 'true')) }}
				
				<div class="modal-header  bg-primary">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span></button>
					<h4 class="modal-title">Новый аудио альбом</h4>
				</div>
				<div class="modal-body">
					
					<div class="form-group">
						<label>Название трека</label>
						{{ Form::text('name', null, array('class' => 'form-control')) }}
					</div>
					
					<div class="form-group">
						<label>Трек</label>
						{{ Form::file('file') }}
					</div>
					
				</div>
				<div class="modal-footer">
	        		<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
					<button type="submit" class="btn btn-primary">Загрузить</button>
				</div>
				
				{{ Form::close() }}
				
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

@stop