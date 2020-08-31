<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterLokasiKerja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_lokasi_kerja', function (Blueprint $table) {
            $table->char('kode_lokasi',2);
            $table->string('nama',100)->unique();
            $table->string('alamat',200);
            $table->string('telpon',20);
            $table->string('kota',200);
            $table->string('provinsi',50);
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
        Schema::dropIfExists('master_lokasi_kerja');
    }
}
