<?php

use Illuminate\Database\Migrations\Migration;

class CreateControlobjectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controlobjectives', function ($table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->text('description', 10000)->nullable();
            $table->string('intref', 16)->nullable();
            $table->string('extref', 16)->nullable();
            $table->boolean('active');
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
        Schema::dropIfExists('controlobjectives');
    }
}
