<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterDataAnakPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_data_anak_pegawai', function (Blueprint $table) {
            $table->char('binusian_id',12);
            $table->integer('anak_ke');
            $table->string('nama',100);
            $table->string('tempat_lahir',100);
            $table->string('tanggal_lahir',100);
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
        Schema::dropIfExists('master_data_anak_pegawai');
    }
}
