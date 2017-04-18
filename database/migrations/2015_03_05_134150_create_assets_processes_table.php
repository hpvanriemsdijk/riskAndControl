<?php

use Illuminate\Database\Migrations\Migration;

class CreateAssetsProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_process', function ($table) {
            $table->integer('asset_id')->unsigned();
            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
            $table->integer('process_id')->unsigned();
            $table->foreign('process_id')->references('id')->on('processes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_process');
    }
}
