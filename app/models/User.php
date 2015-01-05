<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'users';
	protected $guarded = array();
	protected $hidden = array('password', 'remember_token');
	
	public function roles()
    {
        return $this->belongsToMany('Role', 'users_roles');
    }
    
    public static function chk_role($id, $role)
	{
		if($id > 0 && User::find($id)->roles->find($role))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
    
    public function hasRole($check)
    {
	    return in_array($check, array_fetch($this->roles->toArray(), 'name'));
    }
    
    public function hasActive()
    {
		if($this->active == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
    }
	
	public static function isValid($id, $data)
    {
	    $rule = array();
	     
	    $rule['username'] = 'required|min:6|max:32|unique:users,username,' . $id;
	    $rule['firstname'] = 'required|min:3|max:32';
        $rule['lastname'] = 'required|min:3|max:32';
        $rule['email'] = 'required|email|unique:users,email,' . $id;
	    //$rule['country'] = 'required';
        //$rule['city'] = 'required';
        $rule['address'] = 'required';
        $rule['birthday'] = 'required';
	    
	    if($id > 0)
	    {
			$rule['password'] = 'min:6|max:32|same:confirm_password';
			$rule['confirm_password'] = 'min:6|max:32';
	    }
	    else
	    {
		    $rule['password'] = 'required|min:6|max:32|same:confirm_password';
	        $rule['confirm_password'] = 'required|min:6|max:32';
	    }
	    
	    $validator = Validator::make($data, $rule);
	        
        if($validator->passes()) 
		{
			return true;
		}
		else
		{
			return $validator->messages();
		}
    }
    
    public static function isValid_Registration($data)
    {
	    $rule = array(
			'email' => 'required|email|unique:users,email',
			'username' => 'required|min:6|max:32|unique:users,username',
			'password' => 'required|min:6|max:32|same:confirm_password',
	        'confirm_password' => 'required|min:6|max:32'
		);
	    
	    $validator = Validator::make($data, $rule);
	        
        if($validator->passes()) 
		{
			return true;
		}
		else
		{
			return $validator->messages();
		}
    }
	
	public static function save_data($id)
	{
		$data = Input::all();
		$data['username'] = Translit::slug(array_get($data, 'username'), '_');
		
		$validation = self::isValid($id, $data);
		
		if($validation === true)
		{		
			if($id > 0)
			{
				$user = User::find($id);
			}
			else
			{
				$dir = date('Ymd') . '_' . array_get($data, 'username');
				self::makeDirectory('uploads/users/' . $dir);
				
				$user = new User;
				$user->dir = $dir;
				$user->active = 1;
			}
			
			$user->username = array_get($data, 'username');
			$user->firstname = array_get($data, 'firstname');
			$user->lastname = array_get($data, 'lastname');
			$user->birthday = array_get($data, 'birthday');
			$user->country = array_get($data, 'country', 0);
			$user->city = array_get($data, 'city', 0);
			$user->address = array_get($data, 'address', 0);
			$user->email = array_get($data, 'email');
			if(array_get($data, 'password')) $user->password = Hash::make(array_get($data, 'password'));
			
			$user->save();
			
			$user->roles()->detach();
			
			if(!empty($data['roles']))
			{
				foreach($data['roles'] as $role_id)
				{
					$user->roles()->attach($role_id);
				}
			}
			else
			{
				$user->roles()->attach(1);
			}
			
			Session::flash('alert', array('green', 'Ok'));
			
			return $user;
		}
		else
		{
			Session::flash('alert_valid', $validation->toArray());
			Session::flash('post', $data);
			return false;
		}	
	}
	
	public static function destroy_data($id)
	{
		if(!empty($id))
		{
			User::find($id)->delete();
		}
	}
	
	public static function registration()
	{
		$data = Input::all();
		$data['username'] = Translit::slug(array_get($data, 'username'), '_');
		
		$validation = self::isValid_Registration($data);
		
		if($validation === true)
		{
			$dir = date('Ymd') . '_' . array_get($data, 'username');
			self::makeDirectory('uploads/users/' . $dir);

			$user = new User;
			$user->email = array_get($data, 'email');
			$user->username = array_get($data, 'username');
			$user->password = Hash::make(array_get($data, 'password'));
			$user->activation = sha1(array_get($data, 'username') . '@@@' . array_get($data, 'email') . '@@@MusicCubic@@@Activation');
			$user->dir = $dir;
			$user->save();
			$user->roles()->attach(1);

			Session::flash('alert', array('green', 'Ok'));
			
			return $user;
		}
		else
		{
			Session::flash('alert_valid', $validation->toArray());
			Session::flash('post', $data);
			
			return false;
		}
	}
	
	public static function activation($activation)
	{
		$user = User::where('activation', '=', $activation)->first();
		
		if(!empty($user))
		{
			$user->active = '1';
			$user->activation = null;
			$user->save();
			
			return $user;
		}
		else
		{
			return false;
		}
	}
	
	public static function upload_icon() 
	{
		$data = Input::file('image');
		$input = array('image' => Input::file('image'));
		$user = Auth::user();
		
		$validation = Validator::make($input, array(
			'image' => 'required|max:5000|mimes:jpeg,gif,png,bmp'
		));
		
		if($validation->passes() && $user->id) 
		{
			$dir = 'uploads/users/' . $user->dir;

			$img = Image::make($_FILES['image']['tmp_name']);
			$img->save($dir . '/icon.' . $data->getClientOriginalExtension());
		
			$user = User::find($user->id);
			$user->icon = 'icon.' . $data->getClientOriginalExtension();
			$user->save();
		}
		else
		{
			Session::flash('alert_valid', $validation->messages()->toArray());
			return false;
		}
	}
	
	public static function makeDirectory($dir)
	{
		if(!empty($dir) && !is_dir($dir))
		{
			mkdir($dir, 0777);
		}
	}

}
