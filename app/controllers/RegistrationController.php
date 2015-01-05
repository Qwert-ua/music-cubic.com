<?php

class RegistrationController extends Controller {

	public function action_index()
	{
		if(Auth::check())
		{
			return Redirect::to('/');
		}
		else
		{
			$data = array(
				'post' => Session::get('post')
			);
		
			return View::make('site.registration', $data);
		}
	}
	
	public function action_send()
	{
		$user = User::registration();
		
		if($user !== false)
		{
			Mail::queue('emails.welcome', array('activation' => $user->activation), function($message) use ($user)
			{
				 $message->from('no-replay@music-cubic.com', 'MusicCubic');
				 $message->to($user->email, $user->username)->subject('Welcome to MusicCubic Site!');
			});
			
			if(count(Mail::failures()) > 0)
			{
				Session::flash('alert', array('red', 'Не удалось отправить на e-mail код активации обратитесь к администратору сайта'));
			}
		}
		else
		{
			Session::flash('alert', array('red', 'Регистрация не удалась, попробуйте позже'));
		}
		
		return Redirect::back();
	}
	
	public function action_activation($activation = null)
	{
		User::activation($activation);
		Session::flash('alert', array('green', 'Ваш аккаунт активирован, введите имя пользователя и пароль что бы войти'));
		return Redirect::to('/');
	}
}
