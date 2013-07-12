<?php

class People extends Eloquent {
	public static $rules = array(
		'name' => 'required',
		'email' => 'required|unique:peoples|email'
	);

	public static function validate($data){
		return Validator::make($data, static::$rules);
	}

	public function teams(){
		return $this->has_many_and_belongs_to('Team','peoples_teams');
	}

}

?>