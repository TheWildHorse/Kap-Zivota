<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBloodSuppliesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('BloodSupplies', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('institution_id');
			$table->integer('blood_id');
			$table->float('quantity');
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
		Schema::drop('BloodSupplies');
	}

}
