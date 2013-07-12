<?php

class Create_Peoples_Table {    

	public function up()
    {
		Schema::create('peoples', function($table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('peoples');

    }

}