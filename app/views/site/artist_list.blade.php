@extends('site.index')

@section('title_user')
	{{ View::make('site.blocks.title_user', array('user' => Auth::user())) }}
@stop		
	
@section('content')
	<div class="col-md-9">
		
		<blockquote>
			<p>{{ trans('trans.title.artist') }}</p>
		</blockquote>

		<table class="table table-hover">
			<thead>
				<tr>
					<th>{{ trans('trans.name') }}</th>
					<th>&nbsp;</th>
				</tr>
			</thead>

			@foreach($artists as $v_artist)
				<tbody>
					<tr>
						<td>{{ $v_artist->name }}</td>
						<td class="text-right">
						
							<a href="/artist/{{ $v_artist->id }}"><i class="fa fa-eye"></i></a>
							
							&nbsp;&nbsp;
							
							<a href="/artist/edit/{{ $v_artist->id }}"><i class="fa fa-pencil text-success"></i></a>
							
						</td>
					</tr>
				</tbody>
			@endforeach
		</table>

	</div>
@stop