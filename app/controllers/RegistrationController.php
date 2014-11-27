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
		}
		
		return Redirect::to(URL::previous());
	}
	
	public function action_activation($activation = null)
	{
		User::activation($activation);

		return Redirect::to('/');
	}
}
