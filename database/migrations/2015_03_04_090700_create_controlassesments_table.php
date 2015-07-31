<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Test Activities represent the actual tests that have been performed
 */
class CreateControlassesmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('controlassesments', function($table){
			$table->increments('id');
		    $table->date('start')->nullable();
		    $table->date('finish')->nullable();
		    $table->integer('auditor_id')->unsigned()->nullable();
            $table->foreign('auditor_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('auditee_id')->unsigned()->nullable();
            $table->foreign('auditee_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('approveer_id')->unsigned()->nullable();
            $table->foreign('approveer_id')->references('id')->on('users')->onDelete('set null');
		    $table->text('finding', 10000)->nullable();
		    $table->integer('conclusion')->nullable();
		    $table->dateTime('approved_date')->nullable();
		    $table->dateTime('completed_date')->nullable();
		    $table->integer('controlactivity_id')->unsigned()->nullable();
            $table->foreign('controlactivity_id')->references('id')->on('controlactivities')->onDelete('cascade');
		    //$table->integer('threat_id')->unsigned()->nullable();
            //$table->foreign('threat_id')->references('id')->on('threats')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('controlassesments');
	}

}
