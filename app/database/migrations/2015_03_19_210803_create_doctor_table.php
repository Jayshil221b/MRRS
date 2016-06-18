<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('doctors', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_id',50);
			$table->string('type',50);
			$table->string('phn_number',10);
			$table->timestamps();
		});
		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('doctors');
	}

}
