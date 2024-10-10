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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('id_pendaftaran')->unique();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('nisn');
            $table->string('nik');
            $table->string('nama_siswa');
            $table->string('jenis_kelamin');
            $table->string('pas_foto')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('agama')->nullable();

            //Kontak
            $table->string('email')->nullable();
            $table->string('hp')->nullable();

            // Alamat lengkap
            $table->string('alamat')->nullable();
            
            $table->string('provinsi_id')->nullable();
            // $table->foreign('provinsi_id')
            //     ->references('id')
            //     ->on('provinces')
            //     ->onUpdate('cascade')->onDelete('cascade');

            $table->string('kabupaten_id')->nullable();
            // $table->foreign('kabupaten_id')
            //     ->references('id')
            //     ->on('regencies')
            //     ->onUpdate('cascade')->onDelete('cascade');

            $table->string('kecamatan_id')->nullable();
            // $table->foreign('kecamatan_id')
            //     ->references('id')
            //     ->on('districts')
            //     ->onUpdate('cascade')->onDelete('cascade');

            $table->string('kelurahan_id')->nullable();
            // $table->foreign('kelurahan_id')
            //     ->references('id')
            //     ->on('villages')
            //     ->onUpdate('cascade')->onDelete('cascade');


            //data pendaftaran
            $table->unsignedBigInteger('gelombang')->nullable();
            $table->foreign('gelombang')
                ->references('id')
                ->on('jadwal_kegiatan')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('tahun_masuk');
            $table->unsignedBigInteger('pil1')->nullable();
            $table->foreign('pil1')
                ->references('id')
                ->on('jurusan')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('pil2')->nullable();
            $table->foreign('pil2')
                ->references('id')
                ->on('jurusan')
                ->onUpdate('cascade')->onDelete('cascade');

            //data orang tua
            $table->string('nama_ayah')->required();
            $table->string('nama_ibu')->required();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('nohp_ayah')->nullable();
            $table->string('nohp_ibu')->nullable();
            $table->string('penghasilan_ayah')->nullable();
            $table->string('penghasilan_ibu')->nullable();

            $table->string('berkas_ortu');//kk akte ijazah raport penghasilan


            //data nilai dan sekolah
            $table->string('sekolah_asal')->required();
            $table->double('smt1')->required();
            $table->double('smt2')->required();
            $table->double('smt3')->required();
            $table->double('smt4')->required();
            $table->double('smt5')->required();
            $table->double('smt6')->required();
            $table->string('berkas_siswa');//kk akte ijazah raport penghasilan
            $table->string('prestasi')->nullable();


            $table->string('status_pendaftaran');
            $table->datetime('tgl_pendaftaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
