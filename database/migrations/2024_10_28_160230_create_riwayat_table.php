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
            $table->unsignedBigInteger('no_rm')->index();
            $table->unsignedBigInteger('id_dokter')->index();
            $table->unsignedBigInteger("id_penanggung_jawab")->index();
            $table->string('poliklinik_tujuan');
            $table->string('cara_masuk');
            $table->string('pembayaran');
            $table->string('no_asuransi')->nullable();
            $table->enum('status', ['Asesmen Awal', 'Pemeriksaan', 'Laboratorium', 'Radiologi', 'Farmasi', 'Kasir', 'Pasien Pulang'])->default('Asesmen Awal');
            $table->integer('no_antrian')->default(1);

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
