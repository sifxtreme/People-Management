<?php

class Create_Weeks_Table {    

	public function up()
    {
		Schema::create('weeks', function($table) {
			$table->increments('id');
			$table->integer('week');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('weeks');

    }

}