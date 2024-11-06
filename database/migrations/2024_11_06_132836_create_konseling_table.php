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
        Schema::create('konseling', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_riwayat")->index();
            $table->string("keluhan");
            $table->string("riwayat_kasus")->nullable();
            $table->string("asesmen")->nullable();
            $table->string("dinamika_psikologi")->nullable();
            $table->string("prioritas_intervensi")->nullable();
            $table->string("intervensi");
            $table->string("rencana_intervensi_lanjutan")->nullable();
            $table->json("klarifikasi_masalah")->nullable();

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
        Schema::dropIfExists('konseling');
    }
};
