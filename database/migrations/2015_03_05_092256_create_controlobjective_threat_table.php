<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateControlobjectiveThreatTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('controlobjective_threat', function($table){
		    $table->integer('controlobjective_id')->unsigned();
            $table->foreign('controlobjective_id')->references('id')->on('controlobjectives')->onDelete('cascade');
            $table->integer('threat_id')->unsigned();
            $table->foreign('threat_id')->references('id')->on('threats')->onDelete('cascade');
            $table->integer('eec')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('controlobjective_threat');
	}

}
