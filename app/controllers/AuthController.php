<?php

class AuthController extends Controller {

	public function action_index()
	{
		if(Auth::check())
		{
			return Redirect::to('/');
		}
		else
		{
			return View::make('site.auth');
		}
	}
	
	public function action_login()
	{
		$data = Input::all();
	
		$auth = Auth::attempt(array(
			'email' => array_get($data, 'email'), 
			'password' => array_get($data, 'password'),
			'active' => 1
		), (Input::has('remember') ? true : false));
		
		$auth_user = Auth::user();
		
		/*if($auth === true && $auth_user->hasRole('login') === true && $auth_user->hasActive() === true)
		{
			return Redirect::intended('/');	
		}
		else if($auth === true && $auth_user->hasRole('login') === true && $auth_user->hasActive() === false)
		{
			Session::flash('alert', array('yellow', 'Аккаунт заблокирован !'));
			return Redirect::back();
		}
		else
		{
			Session::flash('alert', array('red', 'Не правильно ведено имя пользователя и/или пароль !'));
			return Redirect::back();
		}*/
		
		if($auth === true && $auth_user->hasRole('login') === true)
		{
			return Redirect::intended('/');	
		}
		else
		{
			Session::flash('alert', array('yellow', 'Не правильно ведено имя пользователя и/или пароль или аккаунт заблокирован !'));
			return Redirect::back();
		}
	}
	
	public function action_logout()
	{
		Auth::logout();
		return Redirect::to('/');
	}
	
	// =========================== Admin =========================== //
	
	public function action_admin_index()
	{
		return View::make('admin.auth');
	}
	
	public function action_admin_login()
	{
		$data = Input::all();
	
		$auth = Auth::attempt(array(
			'username' => array_get($data, 'username'), 
			'password' => array_get($data, 'password'),
			'active' => 1
		));
		
		$auth_user = Auth::user();
		
		/*if($auth === true && $auth_user->hasRole('admin') === true && $auth_user->hasActive() === true)
		{
			return Redirect::intended('admin');	
		}
		else if($auth === true && $auth_user->hasRole('admin') === true && $auth_user->hasActive() === false)
		{
			Session::flash('alert', array('yellow', 'Аккаунт заблокирован !'));
			return Redirect::back();
		}
		else
		{
			Session::flash('alert', array('red', 'Не правильно ведено имя пользователя и/или пароль !'));
			return Redirect::back();
		}*/
		
		if($auth === true && $auth_user->hasRole('admin') === true)
		{
			return Redirect::intended('admin');	
		}
		else
		{
			Session::flash('alert', array('yellow', 'Не правильно ведено имя пользователя и/или пароль или аккаунт заблокирован !'));
			return Redirect::back();
		}
	}
	
	public function action_admin_logout()
	{
		Auth::logout();
		return Redirect::to('/');
	}
	
}
