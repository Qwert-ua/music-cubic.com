<?php
	
class Photo extends Eloquent {

	protected $table = 'photos';
	
	public static function isValid($data)
    {
	    $validator = Validator::make($data, [
		    'name' => 'required|max:32'
	    ]);
	        
        if($validator->passes()) 
		{
			return true;
		}
		else
		{
			return $validator->messages();
		}
    }
    
    public static function save_data($id = 0)
	{
		$data = Input::all();
		$user = Auth::user();
		
		if(self::isValid($data) === true && $user->id)
		{		
			if($id > 0)
			{
				$photo = Photo::find($id);
			}
			else
			{
				$dir = self::makeDirectory();
				
				$photo = new Photo;
				$photo->user_id = $user->id;
				$photo->dir = $dir;
			}
			
			$photo->name = array_get($data, 'name');
			$photo->description = array_get($data, 'description');
			$photo->save();
			
			Session::flash('alert', array('green', 'Ok'));
			return $photo;
		}
		else
		{
			Session::flash('alert_valid', self::isValid($data)->toArray());
			return false;
		}	
	}
	
	public static function destroy_data($id)
	{
		$user = Auth::user();
		
		if(!empty($id))
		{
			$photo = Photo::where('id', '=', $id)->where('user_id', '=', $user->id)->first();
			if(!empty($photo) && File::deleteDirectory('./uploads/users/' . $user->dir . '/images/' . $photo->dir))
			{
				$photo->delete();
				Photo::where('subid', '=', $id)->where('user_id', '=', $user->id)->delete();
			}
			
			Session::flash('alert', array('green', 'Удалено'));
		}
	}
	
	public static function get_album($id = 0)
	{
		$user = Auth::user();
		
		if($id > 0)
		{
			return Photo::where('user_id', '=', $user->id)->where('id', '=', $id)->first();
		}
		else
		{
			return Photo::where('user_id', '=', $user->id)->where('subid', '=', 0)->get();
		}
	}
	
	public static function get_photos($id = 0, $edit = false)
	{
		$user = Auth::user();
		$photo = Photo::where('user_id', '=', $user->id)->where('subid', '=', $id)->get();
		
		if(!empty($photo))
		{
			$data = array(
				'album_id' => $id,
				'images' => $photo,
				'user' => $user,
				'edit' => $edit
			);
			
			return View::make('images', $data);
		}
		else
		{
			return null;
		}
	}
	
	public static function makeDirectory()
	{
		$user = Auth::user();
		$dir = './uploads/users/' .  $user->dir . '/images/album_' . time();
		
		if(!is_dir($dir))
		{
			mkdir($dir, 0777, true);
		}
		
		return 'album_' . time();
	}
	
	public static function get_first($id)
	{
		$user = Auth::user();
		
		$photo = Photo::where('subid', '=', $id)->where('user_id', '=', $user->id)->orderBy('position')->orderBy('id')->first();
		
		if(!empty($photo))
		{
			return '/imagecache/icon/' . $user->dir . '/images/' . $photo->dir . '/' . $photo->file;
		}
		else
		{
			return null;
		}
	}
	
	public static function delete_img($id)
	{
		$photo = Photo::find($id);
		$user = Auth::user();
		
		if(!empty($photo))
		{
			@unlink('./uploads/users/' . $user->dir . '/images/' . $photo->dir . '/' . $photo->file);
			$photo->delete();
			
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public static function upload_images($id) 
	{
		$user = Auth::user();
		$dir_gallery = Photo::where('id', '=', $id)->where('user_id', '=', $user->id)->first()->dir;
		
		$dir = './uploads/users/' . $user->dir . '/images/' . $dir_gallery . '/';		
		
		if(!is_dir($dir))
		{
			mkdir($dir, 0777, true);
		}
		
		$data = Input::file('images');
		$input = array('images' => Input::file('images'));
		
		$validation = Validator::make($input, array(
			'images' => 'max:10240|mimes:jpeg,gif,png'
		));
		
		if($validation->passes()) 
		{
			$file_name = Str::random(20) . '.' . $data->getClientOriginalExtension();
			
			//$data->move($dir, $file_name);
			
			$img = Image::make($_FILES['images']['tmp_name']);
			$img->resize(null, 540, function ($constraint) {
				$constraint->aspectRatio();
				$constraint->upsize();
			});
			$img->save($dir . $file_name);
			
			$photo = new Photo();
			$photo->subid = $id;
			$photo->file = $file_name;
			$photo->dir = $dir_gallery;
			$photo->user_id = $user->id;
			$photo->save();
		
			return true;
		}
		else
		{
			//Session::flash('alert_valid', $validation->messages()->toArray());
			return false;
		}
	}
}
