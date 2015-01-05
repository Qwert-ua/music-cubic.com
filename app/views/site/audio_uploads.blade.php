@extends('site.index')

@section('title_user')
	{{ View::make('site.blocks.title_user', array('user' => Auth::user())) }}
@stop		
	
@section('content')

	<div class="col-md-9">
		
		<blockquote>
			<p>{{ trans('trans.title.upload_music') }}</p>
		</blockquote>

		{{ Form::open([ 'url' => 'audio', 'files' => 'true' ]) }}

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>{{ trans('trans.form.author') }}</label>
						{{ Form::select('artist', array('0' => trans('trans.form.sel_artist')) + $artists->lists('name', 'id'), NULL, array('class' => 'form-control select_artist')) }}
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label>{{ trans('trans.form.name_track') }}</label>
						{{ Form::text('track', null, array('class' => 'form-control hide_select', 'disabled' => 'disabled')) }}
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>{{ trans('trans.form.album') }}</label>
						{{ Form::text('album', null, array('class' => 'form-control hide_select', 'disabled' => 'disabled')) }}
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label>{{ trans('trans.form.year') }}</label>
						{{ Form::selectRange('release', date('Y'), 1900, null, array('class' => 'form-control hide_select', 'disabled' => 'disabled')) }}
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<label>{{ trans('trans.form.cover') }} <small class="text-muted">(JPG, GIF, PNG; 240x240 px)</small></label>
					<div class="input-group">
		                <span class="input-group-btn">
		                    <span class="btn btn-primary btn-file active">
		                        {{ trans('trans.btn.browse') }}&hellip; <input type="file" name="cover" disabled="disabled" class="hide_select">
		                    </span>
		                </span>
		                <input type="text" class="form-control" readonly>
		            </div>
				</div>

				<div class="col-md-6">
					<label>{{ trans('trans.form.file') }} <small class="text-muted">(MP3)</small></label>
					<div class="input-group">
		                <span class="input-group-btn">
		                    <span class="btn btn-primary btn-file active">
		                        {{ trans('trans.btn.browse') }}&hellip; <input type="file" name="audio" disabled="disabled" class="hide_select">
		                    </span>
		                </span>
		                <input type="text" class="form-control" readonly>
		            </div>
				</div>
			</div>
			
			<br />

			<button type="submit" class="btn btn-success hide_select btn-block" disabled>{{ trans('trans.btn.upload') }} </button>

		{{ Form::close() }}

	</div>

@stop