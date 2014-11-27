<div class="col-md-3">
	<blockquote>
		@if(!empty($user->firstname) && !empty($user->lastname))
			<p>{{ $user->firstname }} {{ $user->lastname }}</p>
		@else
			<p>{{ $user->username }}</p>
		@endif
	</blockquote>
	<div class="clearfix"></div>
	<div class="avatar">
	<img class="img-rounded user-icon-images " src="/uploads/users/{{ $user->dir }}/{{ $user->icon }}" alt="{{ $user->username }}">
	<div class="user-icon-panel text-center ">
		
		<div class="btn-group">
			<a href="edit" class="btn btn-sm btn-link btn-user-iconimages"><i class="fa fa-pencil-square-o"></i> Редактировать</a>	
			<button type="button" class="btn btn-sm btn-link btn-user-iconimages" data-toggle="modal" data-target="#UploadUserIcon"><i class="fa fa-download"></i> Загрузить новую</button>
		</div>
		
	</div>
	</div>
</div>