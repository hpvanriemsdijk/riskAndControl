
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Test of controls define how the effectiveness of the control should be tested
 */
class CreateTestofcontrolsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('testofcontrols', function($table){
		    $table->increments('id');
		    $table->string('name', 64);
		    $table->text('test', 10000)->nullable();
		    $table->integer('controlactivity_id')->unsigned()->nullable();
            $table->foreign('controlactivity_id')->references('id')->on('controlactivities')->onDelete('set null');
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
		Schema::dropIfExists('testofcontrols');
	}

}
