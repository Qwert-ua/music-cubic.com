@if(array_get($artist, 'nickname'))
	<div style="position: absolute;
		top: 57px;
		left: 0;
		width: 100%;
		height: 476px;
		background: #ebebeb url('/uploads/artists/{{ array_get($artist, 'nickname') }}/cover.jpg');
		background-position: top center;
		background-repeat: no-repeat;
		background-size: cover;
		overflow: hide;">
	</div>
	
	
	<div class="container">
		<div class="row artist-top">
			<div class="col-xs-3">
		
				<div class="avatar avatar-artist">
					
					<img class="img-rounded user-icon-images " src="/imagecache/user/artists/{{ array_get($artist, 'nickname') }}/{{ array_get($artist, 'icon') }}" alt="">
					
					<div class="user-icon-panel text-center ">
						<div class="btn-group">
							<a href="/artist/{{ array_get($artist, 'nickname') }}/edit" class="btn btn-sm btn-link btn-user-iconimages"><i class="fa fa-pencil-square-o"></i> {{ trans('trans.btn.edit') }}</a>	
							<button type="button" class="btn btn-sm btn-link btn-user-iconimages" data-toggle="modal" data-target="#UploadIcon"><i class="fa fa-download"></i> {{ trans('trans.btn.upload_icon') }}</button>
						</div>
					</div>
				</div>
		
			</div>
			
			<div class="col-xs-9">
				
				@if(!empty($edit))
					<button type="button" class="btn btn-default pull-right link-artist-cover" data-toggle="modal" data-target="#UploadCover"><i class="fa fa-camera"></i> Загрузить ковер</button>
				@endif
				
			</div>
		</div>
	</div>
	
	<!-- Modal Content -->

	<div class="modal fade" id="UploadIcon">
		<div class="modal-dialog">
			<div class="modal-content">
				{{ Form::open(array('url' => 'artist/uploadicon/' . $artist->id, 'files' => 'true')) }}
				
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
	
	<div class="modal fade" id="UploadCover">
		<div class="modal-dialog">
			<div class="modal-content">
				{{ Form::open(array('url' => 'artist/uploadcover/' . $artist->id, 'files' => 'true')) }}
				
				<div class="modal-header  bg-primary">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span></button>
					<h4 class="modal-title">Загрузка ковера</h4>
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
@endif