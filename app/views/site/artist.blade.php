@extends('site.index')	
	
@section('content')

<div style="position: absolute;
	top: 55px;
	left: 0;
	width: 100%;
	height: 476px;
	background-image: url('/uploads/artists/{{ $artist->login }}/cover.jpg');
	background-position: center center;
	background-repeat: no-repeat;
	background-size: cover;
	overflow: hide;"></div>

<div class="container">
	<div class="row artist-top">
		<div class="col-xs-3">
	
			<div class="avatar avatar-artist">
				<img class="img-rounded user-icon-images " src="/imagecache/user/artists/{{ $artist->login }}/avatar.jpg" alt="">
				
				<div class="user-icon-panel text-center ">
					<div class="btn-group">
						<a href="#" class="btn btn-sm btn-link btn-user-iconimages"><i class="fa fa-pencil-square-o"></i> {{ trans('trans.btn.edit') }}</a>	
						<button type="button" class="btn btn-sm btn-link btn-user-iconimages" data-toggle="modal" data-target="#UploadUserIcon"><i class="fa fa-download"></i> {{ trans('trans.btn.upload_icon') }}</button>
					</div>
				</div>
			</div>
	
		</div>
		
		<div class="col-xs-9">
			
		</div>
	</div>
</div>


<div class="container">
	<div class="row">
		<div class="col-md-3">
			<blockquote>
				{{ trans('trans.title.about_artist') }}
			</blockquote>
			<div class="clearfix"></div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			
			<br />
			<br />
			
			<blockquote>
				{{ trans('trans.title.my_afisha') }}
			</blockquote>
			<div class="clearfix"></div>
		</div>
	
		<div class="col-md-9">
		
			<blockquote>
				<p>{{ $artist->name }}</p>
			</blockquote>
			
			qwdqwd
					
		</div>
	</div>	
</div>

@stop