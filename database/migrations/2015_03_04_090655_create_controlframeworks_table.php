<?php

use Illuminate\Database\Migrations\Migration;

class CreateControlframeworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controlframeworks', function ($table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->text('description', 10000)->nullable();
            $table->boolean('active');
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
        Schema::dropIfExists('controlframeworks');
    }
}
