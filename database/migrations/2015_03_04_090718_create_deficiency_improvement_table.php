<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeficiencyImprovementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('deficiency_improvement', function($table){
		    $table->integer('deficiency_id')->unsigned();
            $table->foreign('deficiency_id')->references('id')->on('deficiencies')->onDelete('cascade');
            $table->integer('improvement_id')->unsigned();
            $table->foreign('improvement_id')->references('id')->on('improvements')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('deficiency_improvement');
	}

}
