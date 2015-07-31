<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreatTargetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('threat_targets', function($table){
            $table->integer('threat_id')->unsigned();
            $table->foreign('threat_id')->references('id')->on('threats')->onDelete('cascade');
            $table->morphs('threat_target');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('threat_targets');
	}
}
