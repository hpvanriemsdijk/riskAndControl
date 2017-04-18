<?php

use Illuminate\Database\Migrations\Migration;

class CreateDeficienciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deficiencies', function ($table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->text('description', 10000)->nullable();
            $table->text('rootcause', 10000)->nullable();
            $table->integer('owner_id')->unsigned()->nullable();
            $table->foreign('owner_id')->references('id')->on('roles')->onDelete('set null');
            $table->integer('controlassesment_id')->unsigned();
            $table->foreign('controlassesment_id')->references('id')->on('controlassesments')->onDelete('cascade');
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
        Schema::dropIfExists('deficiencies');
    }
}
