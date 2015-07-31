<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('threats', function($table){
		    $table->increments('id');
		    $table->string('name', 64);
		    $table->text('description', 10000)->nullable();
		    $table->integer('chance')->default(5);
		    $table->integer('impact')->default(5);

			// These columns are needed for Baum's Nested Set implementation to work.
			// Column names may be changed, but they *must* all exist and be modified
			// in the model.
			$table->integer('parent_id')->nullable()->index();
			$table->integer('lft')->nullable()->index();
			$table->integer('rgt')->nullable()->index();
			$table->integer('depth')->nullable();

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
		Schema::dropIfExists('threats');
	}

}
