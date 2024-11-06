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
        Schema::create('pasien', function (Blueprint $table) {
            $table->id('no_rm');
            $table->string('nama')->index();
            $table->string('nama_keluarga');
            $table->string('nik');
            $table->string('no_identitas_lain');
            $table->char('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->integer('umur');
            $table->string('nama_ibu');
            $table->string('no_telp');
            $table->string('no_telp_rumah');
            $table->string('agama');
            $table->string('pendidikan');
            $table->string('status_pernikahan');
            $table->string('gol_darah');
            $table->string('pekerjaan');
            $table->string('suku')->nullable();
            $table->string('bahasa')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->string('alamat');
            $table->string('rw');
            $table->string('rt');
            $table->string('kode_pos');
            $table->binary('signature');
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
        Schema::dropIfExists('pasien');
    }
};
