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
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();
            $table->string('id_pengumuman')->unique();
            $table->string('id_pendaftaran');
            $table->string('user_id')->nullable();
            $table->string('hasil_seleksi')->nullable();
            $table->unsignedBigInteger('jurusan_penerima')->nullable();
            $table->foreign('jurusan_penerima')
                ->references('id')
                ->on('jurusan')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('nilai_interview')->nullable();
            $table->integer('nilai_test')->nullable();
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};
