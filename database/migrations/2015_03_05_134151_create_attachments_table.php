<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration {

	public function up()
	{
		Schema::create('attachments', function($table)
		{
			$table->increments('id');
			$table->string('filename');
			$table->string('mime');
			$table->string('original_filename');
			$table->timestamps();
		});
	}
 
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attachments');
	}
}