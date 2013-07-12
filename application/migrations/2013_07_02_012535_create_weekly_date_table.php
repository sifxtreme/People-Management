<?php

class Create_Weekly_Date_Table {    

	public function up()
    {
		Schema::create('weekly_date', function($table) {
			$table->increments('id');
			$table->integer('people_id');
			$table->integer('partner_id');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('weekly_date');

    }

}