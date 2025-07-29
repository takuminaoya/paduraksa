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
        Schema::create('laporan_masyarakats', function (Blueprint $table) {
            $table->id();
            $table->uuid();

            $table->string('klasifikasi');
            $table->string('judul');
            $table->longText('isi');
            $table->date('tanggal_kejadian');
            $table->string('lokasi_kejadian');
            $table->string('banjar_kejadian');

            $table->boolean('anonim')->default(false);
            $table->boolean('rahasia')->default(false);

            $table->string('lampiran')->nullable();

            // informasi pengguna
            $table->string('nik');
            $table->string('nama');
            $table->string('alamat');
            $table->string('tanggal_lahir');
            $table->enum('jenis_kelamin', [
                'laki-laki',
                'perempuan',
                'rahasia'
            ])->default('rahasia');
            $table->string('no_telpon');
            $table->string('pekerjaan');
            $table->boolean('penyandang_disabilitas')->default(false);

            $table->string('status')->default('aktif');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_masyarakats');
    }
};
