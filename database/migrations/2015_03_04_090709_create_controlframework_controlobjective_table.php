<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateControlframeworkControlobjectiveTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('controlframework_controlobjective', function($table){
		    $table->integer('controlframework_id')->unsigned();
            $table->foreign('controlframework_id')->references('id')->on('controlframeworks')->onDelete('cascade');
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
		Schema::dropIfExists('controlframework_controlobjective');
	}
}