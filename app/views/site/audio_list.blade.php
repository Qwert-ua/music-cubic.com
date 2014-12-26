@extends('site.index')

@section('title_user')
	{{ View::make('site.blocks.title_user', array('user' => Auth::user())) }}
@stop		
	
@section('content')
	<div class="col-md-9">
		
		<blockquote>
			<p>{{ trans('trans.title.list_music') }}</p>
		</blockquote>

		<table class="table table-hover">
			<thead>
				<tr>
					<th>Артист</th>
					<th>Альбом</th>
					<th>Песня</th>
				</tr>
			</thead>

			@foreach($audio as $v_audio)
				<tbody>
					<tr>
						<td>{{ $v_audio->artist }}</td>
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