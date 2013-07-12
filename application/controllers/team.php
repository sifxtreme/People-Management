<?php

class Team_Controller extends Base_Controller {

	public $restful = true;

	// return all teams
	public function get_index() {
		return View::make('team.index');
	}

	// create new team
	public function post_new() {
		$validation = Team::validate(Input::all());

		if($validation->passes()){
			Team::create(array(
				'name'=>Input::get('name')
			));

			return Redirect::to_route('teams')
				->with('success','Team added');
		}
		else{
			return Redirect::to_route('teams')
				->with('error',	$validation->errors->first())
				->with_input();
		}

	}

	// delete team
	public function post_delete() {

		$team_id = Input::get('id');
		Team::find($team_id)->delete();

		// delete team from other tables
		DB::table('matches')->where('team_id','=',$team_id)->delete();
		DB::table('peoples_teams')->where('team_id','=',$team_id)->delete();

		return Redirect::to_route('teams')
			->with('success','Team removed');

	}

	// get info for specific team
	public function get_team($id = null){

		if($id === null || Team::find($id) === null){
			return Redirect::to_route('teams');
		}
		else{
			return View::make('team.team')
				->with('team_id', $id);
		}

	}

	// add new people to team
	public function post_new_people(){

		$people_id = Input::get('member_id');
		$team_id = Input::get('team_id');
		$people = People::find($people_id);
		$team = Team::find($team_id);

		if($people == null){

			return Redirect::to_route('team', array($team_id))
				->with('error','Please select an existing person');

		}
		else if(DB::table('peoples_teams')->where('people_id', '=', $people_id)->where('team_id', '=', $team_id)->count() > 0){

			return Redirect::to_route('team', array($team_id))
				->with('error','This person is already on this team');

		}
		else{

			// add to matches table!
			foreach($team->peoples()->get() as $single_person){
				DB::table('matches')->insert(array(
					'team_id' => $team_id,
					'people_id' => $people_id,
					'other_people_id' => $single_person->id,
					'frequency' => 0
				));
				DB::table('matches')->insert(array(
					'team_id' => $team_id,
					'people_id' => $single_person->id,
					'other_people_id' => $people_id,
					'frequency' => 0
				));
			}

			$team->peoples()->attach($people);

			return Redirect::to_route('team', array($team_id))
				->with('success','Person has been added to this team');

		}

	}

	// remove people from team
	public function post_remove_people(){

		$people_id = Input::get('member_id');
		$team_id = Input::get('team_id');

		DB::table('peoples_teams')->where('people_id','=',$people_id)->where('team_id','=',$team_id)->delete();

		// remove from other tables
		DB::table('matches')->where('people_id','=',$people_id)->where('team_id','=',$team_id)->delete();

		return Redirect::to_route('team', array($team_id))
			->with('success','Person has been removed from this team');

	}

}