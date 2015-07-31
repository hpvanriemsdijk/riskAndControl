<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImprovementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('improvements', function($table){
		    $table->increments('id');
		    $table->string('name', 64);
		    $table->text('description', 10000)->nullable();
		    $table->integer('status');	//0: todo, 1: in progress, 2: done
		    $table->integer('owner_id')->unsigned()->nullable();
            $table->foreign('owner_id')->references('id')->on('roles')->onDelete('set null');
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
		Schema::dropIfExists('improvements');
	}

}
