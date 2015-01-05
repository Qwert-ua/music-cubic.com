@foreach($images as $val_image)
	<div class="col-xs-2 col-md-3 sortable-item" data-id="{{$val_image->id}}">
		<a href="/uploads/users/{{$user->dir}}/images/{{$val_image->dir}}/{{$val_image->file}}" 
					data-lightbox="roadtrip" 
					class="thumbnail thumbnail-look">	
			<img src="/imagecache/icon/{{$user->dir}}/images/{{$val_image->dir}}/{{$val_image->file}}" />
			@if($edit)
				<div class="look"></div>
			@endif
		</a>
		
		@if($edit)
			<button 
				type="button" 
				class="btn btn-link delimg"           
				onclick="ajax_imgdel({{$album_id}}, {{$val_image->id}})" 
				data-confirm="Вы действительно хотите удалить ?"
				data-original-title="Delete"
			><i class="fa fa-trash"></i></button>
		@endif
	</div>
@endforeach