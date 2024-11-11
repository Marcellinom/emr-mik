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
        Schema::create('soap', function (Blueprint $table) {
            $table->unsignedBigInteger('id_riwayat')->index();
            $table->string("subjektif")->nullable();
            $table->string("asesmen")->nullable();
            $table->string("objektif")->nullable();
            $table->string("rencana")->nullable();

            $table->boolean('penjelasan_penyakit')->default(false);
            $table->boolean('penjelasan_obat')->default(false);
            $table->boolean('penjelasan_informed_consent')->default(false);
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
        Schema::dropIfExists('soap');
    }
};
