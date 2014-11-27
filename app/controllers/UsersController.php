<?php

class UsersController extends Controller {

	public function action_index()
	{
		return View::make('site.index');
	}
	
	public function action_upload_icon()
	{
		User::upload_icon();
		
		return Redirect::to(URL::previous());
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
			return Redirect::to(URL::previous()); 
		}
		else
		{
			return Redirect::to('admin/users/form/' . $user->id); 
		}
	}
	
	public function action_admin_destroy($id = false)
	{
		User::destroy_data($id);
		return Redirect::to(URL::previous());
	}

}
