<?php

class Create_Matches_Table {    

	public function up()
    {
		Schema::create('matches', function($table) {
			$table->increments('id');
			$table->integer('team_id');
			$table->integer('people_id');
			$table->index('people_id');
			$table->integer('other_people');
			$table->integer('frequency');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('matches');

    }

}