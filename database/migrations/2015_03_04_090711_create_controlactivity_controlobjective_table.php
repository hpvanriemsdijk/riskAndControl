<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateControlactivityControlobjectiveTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('controlactivity_controlobjective', function($table){
		    $table->integer('controlactivity_id')->unsigned();
            $table->foreign('controlactivity_id')->references('id')->on('controlactivities')->onDelete('cascade');
            $table->integer('controlobjective_id')->unsigned();
            $table->foreign('controlobjective_id')->references('id')->on('controlobjectives')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('controlactivity_controlobjective');
	}

}
