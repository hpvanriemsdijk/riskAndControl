<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration {

	/**
	 * Run the migrations.
	 * 
	 * This model uses Baum to realize a three structure.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('assets', function($table){
		    $table->increments('id');
		    $table->string('name', 64);
		    $table->text('description', 10000)->nullable();
		    $table->boolean('active')->default(1);
		    $table->integer('owner_id')->unsigned()->nullable();
            $table->foreign('owner_id')->references('id')->on('roles')->onDelete('set null');
            $table->integer('maintainer_id')->unsigned()->nullable();
            $table->foreign('maintainer_id')->references('id')->on('roles')->onDelete('set null');
            $table->integer('continuity')->default(5);
            $table->integer('integrity')->default(5);
            $table->integer('availability')->default(5);
            $table->integer('type');	//'People', 'Application', 'Technology', 'Facility', 'Data'

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
		Schema::dropIfExists('assets');
	}

}
