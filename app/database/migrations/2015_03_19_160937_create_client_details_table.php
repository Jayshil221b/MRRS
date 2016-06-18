<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clinic_detail', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('clinic_name',50);
			$table->string('address',50);
			$table->string('doctor_id',50);
			//$table->string('user_id',50);
			$table->string('clinic_phn',10);
			$table->string('clinic_open_time',10);
			$table->string('clinic_close_time',10);
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
		Schema::drop('clinic_detail');
	}

}
