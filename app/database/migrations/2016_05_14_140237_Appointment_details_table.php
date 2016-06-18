<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AppointmentDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('appointments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('doctor_id',50);
			$table->string('patient_id',50);
			$table->string('datetime',500);
			$table->string('status',500);
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
		//
	}

}
