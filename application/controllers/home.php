<?php

class Home_Controller extends Base_Controller {

	public $restful = true;

	public function get_index() {
		return View::make('home.index');
	}

	public function post_index() {
		$credentials = array(
			'username'=>Input::get('email'),
			'password'=>Input::get('password')
		);

		if( Auth::attempt($credentials) ) // successful login
		{
			return Redirect::to_route('home')->with('success','You are logged in');
		}
		else // bad login
		{
			return Redirect::to_route('home')
				->with('error', 'Login credentials incorrect')
				->with_input();
		}

	}

}