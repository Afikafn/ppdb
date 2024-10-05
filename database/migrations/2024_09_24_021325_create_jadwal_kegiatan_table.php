<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('id_kegiatan')->unique();
            $table->string('nama_kegiatan');
            $table->string('jenis_kegiatan');
            $table->date('tgl_mulai');
            $table->date('tgl_akhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kegiatan');
    }
};
