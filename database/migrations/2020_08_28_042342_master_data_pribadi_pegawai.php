<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterDataPribadiPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_data_pribadi_pegawai', function (Blueprint $table) {
            $table->char('binusian_id',12);
            $table->string('nip')->unique();
            $table->string('nama');
            $table->string('email');
            $table->char('lokasi_kerja',2);
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
        Schema::dropIfExists('master_data_pribadi_pegawai');
    }
}
