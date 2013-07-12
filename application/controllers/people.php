<?php

class People_Controller extends Base_Controller {

	public $restful = true;

	public function get_index() {
		return View::make('people.index');
	}

	public function post_new() {
		$validation = People::validate(Input::all());

		if($validation->passes()){
			People::create(array(
				'name'=>Input::get('name'),
				'email'=>Input::get('email')
			));

			return Redirect::to_route('people')
				->with('success','Person added');
		}
		else{
			return Redirect::to_route('people')
				->with('error',	$validation->errors->first())
				->with_input();
		}
	}

	public function post_delete() {
		$id = Input::get('id');
		People::find($id)->delete();
		return Redirect::to_route('people')
			->with('success','Person removed');
	}

	public function get_person($id = null){
		if($id === null || People::find($id) === null){
			return Redirect::to_route('people');
		}
		else{
			return View::make('people.person')
				->with('people_id', $id);
		}
	}

}