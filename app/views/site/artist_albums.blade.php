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
					<a href="/artist/{{ $artist->login }}" class="btn btn-default">На страничку исполнителя</a>
					<button type="button" href="#" class="btn btn-default" data-toggle="modal" data-target="#CreateAlbum">Создать аудио альбом</button>
				</div>
				
				<br />
				<br />
				
				<div class="row">
					<div class="col-xs-3">
						<div class="well">Audio Album</div>
					</div>
					
					<div class="col-xs-3">
						<div class="well">Audio Album</div>
					</div>
					
					<div class="col-xs-3">
						<div class="well">Audio Album</div>
					</div>
					
					<div class="col-xs-3">
						<div class="well">Audio Album</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-xs-3">
						<div class="well">Audio Album</div>
					</div>
					
					<div class="col-xs-3">
						<div class="well">Audio Album</div>
					</div>
					
					<div class="col-xs-3">
						<div class="well">Audio Album</div>
					</div>
					
					<div class="col-xs-3">
						<div class="well">Audio Album</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-xs-3">
						<div class="well">Audio Album</div>
					</div>
					
					<div class="col-xs-3">
						<div class="well">Audio Album</div>
					</div>
					
					<div class="col-xs-3">
						<div class="well">Audio Album</div>
					</div>
					
					<div class="col-xs-3">
						<div class="well">Audio Album</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-xs-3">
						<div class="well">Audio Album</div>
					</div>
					
					<div class="col-xs-3">
						<div class="well">Audio Album</div>
					</div>
					
					<div class="col-xs-3">
						<div class="well">Audio Album</div>
					</div>
					
					<div class="col-xs-3">
						<div class="well">Audio Album</div>
					</div>
				</div>
						
			</div>
		</div>	
	</div>
	
	<!-- Modal Content -->

	<div class="modal fade" id="CreateAlbum">
		<div class="modal-dialog">
			<div class="modal-content">
			
				{{ Form::open(array('url' => 'artist/createaudioalbum/' . $artist->id, 'files' => 'true')) }}
				
				<div class="modal-header  bg-primary">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span></button>
					<h4 class="modal-title">Новый аудио альбом</h4>
				</div>
				<div class="modal-body">
					
					<div class="form-group">
						<label>Название</label>
						{{ Form::text('name', null, array('class' => 'form-control')) }}
					</div>
					
					<div class="form-group">
						<label>Релиз</label>
						{{ Form::selectRange('release', date('Y'), 1900, null, array('class' => 'form-control')) }}
					</div>
					
					<div class="form-group">
						<label>Ковер</label>
						{{ Form::file('cover') }}
					</div>
					
				</div>
				<div class="modal-footer">
	        		<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
					<button type="submit" class="btn btn-primary">Создать</button>
				</div>
				
				{{ Form::close() }}
				
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

@stop