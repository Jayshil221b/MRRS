<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescriptionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prescription', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('patient_id',50);
			$table->string('doctor_id',50);
			$table->string('doctor_comment',50);
			$table->string('symptoms',500);
			$table->string('treatment',500);
			$table->string('medicine',500);
			$table->string('disease',500);
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
		Schema::drop('prescription');
	}
		

}
