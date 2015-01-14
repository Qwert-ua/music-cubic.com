@extends('site.index')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-3">
			{{ View::make('site.blocks.title_user', array('user' => Auth::user())) }}
		</div>
		
		<div class="col-md-9">
			
			<blockquote>
				<p>{{ trans('trans.title.artist') }}</p>
			</blockquote>
			
			<a href="/artist/new" class="btn btn-default pull-right">Create new Artist</a>
	
			<table class="table table-hover">
				<thead>
					<tr>
						<th>{{ trans('trans.name') }}</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					@foreach($artists as $v_artist)
						<tr>
							<td>{{ $v_artist->name }}</td>
							<td class="text-right">
							
								<a href="/artist/{{ Translit::slug($v_artist->name) }}"><i class="fa fa-eye"></i></a>
								
								&nbsp;&nbsp;
								
								<a href="/artist/edit/{{ $v_artist->id }}"><i class="fa fa-pencil text-success"></i></a>
								
								&nbsp;&nbsp;
								
								<a href="/artist/delete/{{ $v_artist->id }}"><i class="fa fa-trash text-danger"></i></a>
								
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
	
		</div>
	</div>
</div>

@stop