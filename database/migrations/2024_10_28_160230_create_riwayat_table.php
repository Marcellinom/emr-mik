<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('no_rm');
            $table->unsignedBigInteger('id_dokter');
            $table->string('nama_penanggung_jawab');
            $table->string('no_telp_penanggung_jawab');
            $table->string('hubungan_dengan_pasien');
            $table->string('poliklinik_tujuan');
            $table->string('cara_masuk');
            $table->string('pembayaran');
            $table->string('no_asuransi');

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
        Schema::dropIfExists('riwayat');
    }
};
