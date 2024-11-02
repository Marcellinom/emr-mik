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
        Schema::create('asesmen_awal', function (Blueprint $table) {
            $table->unsignedBigInteger('id_riwayat')->index();

            $table->string("denyut_jantung");
            $table->string("pernapasan");
            $table->string("suhu");
            $table->string("tingkat_kesadaran");
            $table->string("tekanan_darah_sistole");
            $table->string("tekanan_darah_distole");
            $table->string("berat_badan");
            $table->string("tinggi_badan");
            $table->string("keluhan_utama");
            $table->string("riwayat_alergi_obat")->nullable();
            $table->string("riwayat_penyakit")->nullable();
            $table->string("riwayat_pengobatan")->nullable();
            // head to toe
            $table->string("kepala")->nullable();
            $table->string("lidah")->nullable();
            $table->string("punggung")->nullable();
            $table->string("kuku_tangan")->nullable();
            $table->string("mata")->nullable();
            $table->string("langit_langit")->nullable();
            $table->string("perut")->nullable();
            $table->string("persendian_tangan")->nullable();
            $table->string("telinga")->nullable();
            $table->string("leher")->nullable();
            $table->string("genital")->nullable();
            $table->string("tungkai_atas")->nullable();
            $table->string("hidung")->nullable();
            $table->string("tenggorokan")->nullable();
            $table->string("anus_dubur")->nullable();
            $table->string("tungkai_bawah")->nullable();
            $table->string("rambut")->nullable();
            $table->string("tongsil")->nullable();
            $table->string("lengan_atas")->nullable();
            $table->string("jari_kaki")->nullable();
            $table->string("bibir")->nullable();
            $table->string("dada")->nullable();
            $table->string("lengan_bawah")->nullable();
            $table->string("kuku_kaki")->nullable();
            $table->string("gigi_geligi")->nullable();
            $table->string("payudara")->nullable();
            $table->string("jari_tangan")->nullable();
            $table->string("persendian_kaki")->nullable();

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
        Schema::dropIfExists('asesmen_awal');
    }
};
