<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterBatch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_batch', function (Blueprint $table) {
            $table->char('batch_id',2);
            $table->string('start_date');
            $table->string('end_date');
            $table->integer('minimum_age');
            $table->integer('maximum_age');
            $table->string('cutoffdate');
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
        Schema::dropIfExists('master_batch');
    }
}
