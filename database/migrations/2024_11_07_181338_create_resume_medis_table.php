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
        Schema::create('resume_medis', function (Blueprint $table) {
            $table->unsignedBigInteger('id_riwayat')->index();
            $table->enum('status_pulang', ['Pulang', 'Meninggal', 'Konsultasi Kembali', 'Dirujuk']);
            $table->binary('ttd_resume_medis')->nullable();
            $table->binary('ttd_informed_consent')->nullable();
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
        Schema::dropIfExists('resume_medis');
    }
};
