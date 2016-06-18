<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaboratoryDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('laboratory_detail', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('laboratory_name',50);
			$table->string('address',50);
			$table->string('staff_id',50);
			$table->string('laboratory_phn',10);
			$table->string('laboratory_open_time',10);
			$table->string('laboratory_close_time',10);
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
