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
        Schema::create('penanggung_jawab', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penanggung_jawab');
            $table->string('no_telp_penanggung_jawab');
            $table->string('hubungan_dengan_pasien');
            $table->string("jenis_kelamin")->nullable();
            $table->date("tanggal_lahir")->nullable();
            $table->string("pendidikan")->nullable();
            $table->string("pekerjaan")->nullable();
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
        Schema::dropIfExists('penanggung_jawab');
    }
};
