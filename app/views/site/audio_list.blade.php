@extends('site.index')

@section('title_user')
	{{ View::make('site.blocks.title_user', array('user' => Auth::user())) }}
@stop		
	
@section('content')
	<div class="col-md-9">
		
		<blockquote>
			<p>{{ trans('trans.title.list_music') }}</p>
		</blockquote>

		<div class="text-right">
			<a href="/audio/add" class="btn btn-default">{{ trans('trans.btn.add_track') }}</a>
		</div>

		<table class="table table-hover">
			<thead>
				<tr>
					<th>{{ trans('trans.artist') }}</th>
					<th>{{ trans('trans.album') }}</th>
					<th>{{ trans('trans.track') }}</th>
				</tr>
			</thead>

			@foreach($audio as $v_audio)
				<tbody>
					<tr>
						<td>{{ $v_audio->artists->name }}</td>
						<td>{{ !empty($v_audio->album) ? $v_audio->album : 'Not Name' }} <small>{{ $v_audio->release }}</small></td>
						<td>
							{{ $v_audio->track }}
						</td>
					</tr>
				</tbody>
			@endforeach
		</table>

	</div>
@stop