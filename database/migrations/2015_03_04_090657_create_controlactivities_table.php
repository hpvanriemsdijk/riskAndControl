<?php

use Illuminate\Database\Migrations\Migration;

class CreateControlactivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controlactivities', function ($table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->text('description', 10000)->nullable();
            $table->boolean('active');
            $table->boolean('key_control');
            $table->integer('owner_id')->unsigned()->nullable();
            $table->foreign('owner_id')->references('id')->on('roles')->onDelete('set null');
            $table->integer('perform_frequency');                    //Daily, weekly, bi-weekly, mothly, bi-mothly, quarterly, twice a year, yearly
            $table->integer('test_frequency')->nullable();            //Daily, weekly, bi-weekly, mothly, bi-mothly, quarterly, twice a year, yearly
            $table->text('justification', 10000)->nullable();
            $table->string('intref', 16)->nullable();
            $table->string('extref', 16)->nullable();
            $table->integer('control_type')->nullable();            //preventive, corrective, detective
            $table->integer('control_execution')->nullable();        //manual, automated
            $table->integer('control_activitiescol')->nullable();
            $table->integer('implementation_status')->nullable();    //Not implemented, Implemented
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
        Schema::dropIfExists('controlactivities');
    }
}
