<?php

class Create_Peoples_Teams_Table {    

	public function up()
    {
		Schema::create('peoples_teams', function($table) {
			$table->increments('id');
			$table->integer('team_id');
			$table->index('team_id');
			$table->integer('people_id');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('peoples_teams');

    }

}