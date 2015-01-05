<?php

class UsersController extends Controller {

	public function action_index()
	{
		return View::make('site.index');
	}
	
	public function action_upload_icon()
	{
		User::upload_icon();
		
		return Redirect::back();
	}
	
	public function action_edit()
	{
		$data = array(
			'user' => Auth::user()
		);
		
		return View::make('site.edit', $data);
	}
	
	public function action_save()
	{
		User::save_data(Auth::user()->id);
		
		return Redirect::back();
	}
	
	// =========================== Admin =========================== //
	
	public function action_admin_index($role = 1)
	{
		$data = array(
			'role_id' => $role,
			'roles' => Role::all(),
			'users' => Role::find($role)->users
		);
		
		return View::make('admin.users', $data);
	}
	
	public function action_admin_form($id = 0)
	{
		$data = array(
			'id' => $id,
			'roles' => Role::all(),
			'user' => $id ? User::find($id)->toArray() : Session::get('post')
		);
		
		return View::make('admin.users_form', $data);
	}
	
	public function action_admin_save($id = 0)
	{
		$user = User::save_data($id); 
		
		if($user === false)
		{
			return Redirect::back(); 
		}
		else
		{
			return Redirect::to('admin/users/form/' . $user->id); 
		}
	}
	
	public function action_admin_destroy($id = false)
	{
		User::destroy_data($id);
		return Redirect::back();
	}

}
