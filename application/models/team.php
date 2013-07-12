<?php

class Team extends Eloquent {

	public static $rules = array(
		'name' => 'required|unique:teams'
	);

	public static function validate($data){
		return Validator::make($data, static::$rules);
	}

	public function peoples(){
		return $this->has_many_and_belongs_to('People','peoples_teams');
	}

}

?>