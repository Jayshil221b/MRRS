<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			Schema::create('users',function($table)
		{
			$table->increments('id');
			$table->string('username',80)->unique;
			$table->string('firstname',50);
			$table->string('lastname',50);
			$table->string('email',100)->unique;
			$table->integer('role_id')->unsigned();
			$table->string('password',80);
			$table->string('confirmpassword',80);
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
		Schema::drop('users');
	}

}
