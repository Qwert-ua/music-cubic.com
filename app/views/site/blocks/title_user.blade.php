<blockquote>
	@if(!empty($user->firstname) && !empty($user->lastname))
		<p>{{ $user->firstname }} {{ $user->lastname }}</p>
	@else
		<p>{{ $user->username }}</p>
	@endif
</blockquote>

<div class="clearfix"></div>
<div class="avatar">
	<img class="img-rounded user-icon-images " src="/imagecache/user/{{ $user->dir }}/{{ $user->icon }}?{{time()}}" alt="{{ $user->username }}">
	
	<div class="user-icon-panel text-center ">
		<div class="btn-group">
			<a href="/edit" class="btn btn-sm btn-link btn-user-iconimages"><i class="fa fa-pencil-square-o"></i> {{ trans('trans.btn.edit') }}</a>	
			<button type="button" class="btn btn-sm btn-link btn-user-iconimages" data-toggle="modal" data-target="#UploadUserIcon"><i class="fa fa-download"></i> {{ trans('trans.btn.upload_icon') }}</button>
		</div>
	</div>
</div>

<!-- Modal Content -->

<div class="modal fade" id="UploadUserIcon">
	<div class="modal-dialog">
		<div class="modal-content">
			{{ Form::open(array('url' => 'uploadicon', 'files' => 'true')) }}
			
			<div class="modal-header  bg-primary">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
				<span class="sr-only">Close</span></button>
				<h4 class="modal-title">Загрузка аватарки</h4>
			</div>
			<div class="modal-body">
				
				{{ Form::file('image') }}
				
			</div>
			<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Не хочу</button>
				<button type="submit" class="btn btn-primary">Загрузить</button>
			</div>
			
			{{ Form::close() }}
			
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->