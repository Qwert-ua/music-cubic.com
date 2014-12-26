<?php
	
class Photo extends Eloquent {

	protected $table = 'photos';
	
	public static function isValid($data)
    {
	    $validator = Validator::make($data, [
		    'name' => 'required|max:32|'
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
				$photo = new Photo;
				
				$dir = self::makeDirectory( $user->dir, Translit::slug(array_get($data, 'name')) );
			}
			
			$photo->name = array_get($data, 'name');
			$photo->description = array_get($data, 'description');
			
			/*$photo->userid = $user->id;
				$photo->dir = $dir;
				$photo->images = self::upload_file($track_slug, $dir);*/
			
			$photo->save();
			
			Session::put('alert', array('green', 'Ok'));
			return $photo;
		}
		else
		{
			Session::put('alert_valid', self::isValid($data)->toArray());
			return false;
		}	
	}
	
	public static function destroy_data($id)
	{
		if(!empty($id))
		{
			
			
			Session::put('alert', array('green', 'Удалено'));
		}
	}
	
	public static function makeDirectory($dir, $name)
	{
		if(!is_dir('./uploads/users/' . $dir . '/photo/'))
		{
			mkdir('./uploads/users/' . $dir . '/photo', 0777);
		}
		
		if(!is_dir('./uploads/users/' . $dir . '/photo/' . $name))
		{
			mkdir('./uploads/users/' . $dir . '/photo/' . $name, 0777);
		}
	}
	
	public static function upload_images($name, $dir) 
	{
		/*$data = Input::file('iamges');
		$input = array('iamges' => Input::file('iamges'));
		
		$validation = Validator::make($input, array(
			'iamges' => 'max:10240|mimes:jpeg,gif,png'
		));
		
		if($validation->passes() && !empty($name)) 
		{
			$dir = './uploads/users/' . $dir . '/';
			$file_name = $name . '.' . $data->getClientOriginalExtension();
			
			$img = Image::make($_FILES['cover']['tmp_name']);
			$img->fit(250, 250, function ($constraint) {
				$constraint->upsize();
			});
			$img->save($dir . $file_name);
		
			return $file_name;
		}
		else
		{
			Session::put('alert_valid', $validation->messages()->toArray());
			return false;
		}*/
	}
}
