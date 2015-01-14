@extends('site.index')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-3">
			{{ View::make('site.blocks.title_user', array('user' => Auth::user())) }}
		</div>
		
		<div class="col-md-9">
			
			<blockquote>
				<p>{{ trans('trans.title.list_music') }}</p>
			</blockquote>
	
			<div class="pull-right btn-group">
				<button type="button" class="btn btn-default" data-toggle="modal" data-target="#CrPlayList">{{ trans('trans.btn.new_playlist') }}</button>
				<a href="/audio/add" class="btn btn-default">{{ trans('trans.btn.add_track') }}</a>
			</div>
			
			<div class="clearfix"></div>
			
			<br />
	
			
			<div class="row">
				<div class="col-xs-9">		
					<table class="table table-hover">
						<thead>
							<tr>
								<th>{{ trans('trans.artist') }}</th>
								<th>{{ trans('trans.album') }}</th>
								<th>{{ trans('trans.track') }}</th>
							</tr>
						</thead>
						
						<tbody>
							@foreach($audio as $v_audio)
							
								<tr>
									<td>{{ $v_audio->artists->name }}</td>
									<td>{{ !empty($v_audio->album) ? $v_audio->album : 'Not Name' }} <small>{{ $v_audio->release }}</small></td>
									<td>
										{{ $v_audio->track }}
									</td>
								</tr>
							
							@endforeach
						</tbody>
					</table>
				</div>
				
				<div class="col-xs-3">
				
					<table class="table table-hover">
						<thead>
							<tr>
								<th>{{ trans('trans.playlist') }} 
									<a href="#" class="pull-right" data-toggle="tooltip" data-placement="bottom" title="{{trans('trans.edit')}}"><i class="fa fa-pencil-square-o text-success"></i></a></th>
							</tr>
						</thead>
						<tbody>
							@foreach($palylist as $v_palylist)
								<tr>
									<td><a href="#">{{$v_palylist->name}}</a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
					
					<table class="table table-hover">
						<thead>
							<tr>
								<th>{{ trans('trans.artist') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($palylist as $v_palylist)
								<tr>
									<td><a href="#">{{$v_palylist->name}}</a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
					
					<table class="table table-hover">
						<thead>
							<tr>
								<th>{{ trans('trans.album') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($palylist as $v_palylist)
								<tr>
									<td><a href="#">{{$v_palylist->name}}</a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
					
					<table class="table table-hover">
						<thead>
							<tr>
								<th>{{ trans('trans.genre') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($palylist as $v_palylist)
								<tr>
									<td><a href="#">{{$v_palylist->name}}</a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
					
				</div>
			</div>	
		</div>
		
		<!-- Modal Content -->
	
		<div class="modal fade" id="CrPlayList">
			<div class="modal-dialog">
				<div class="modal-content">
					{{ Form::open(array('url' => 'audio/create-playlist')) }}
					
					<div class="modal-header  bg-primary">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
						<span class="sr-only">{{ trans('trans.btn.close') }}</span></button>
						<h4 class="modal-title">{{ trans('trans.title.create_playlist') }}</h4>
					</div>
					<div class="modal-body">
						
						<div class="form-group">
							<label>{{ trans('trans.form.name') }}</label>
							{{ Form::text('name', null, array('class' => 'form-control')) }}
						</div>
						
					</div>
					<div class="modal-footer">
		        		<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('trans.btn.close') }}</button>
						<button type="submit" class="btn btn-success">{{ trans('trans.btn.save') }}</button>
					</div>
					
					{{ Form::close() }}
					
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div>	
</div>
@stop