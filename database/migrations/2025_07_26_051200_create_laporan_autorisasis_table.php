<?php

use App\Models\User;
use App\Models\LaporanMasyarakat;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_autorisasis', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(LaporanMasyarakat::class)->constrained()->cascadeOnDelete();
            $table->string('tipe_autorisasi')->default('verifikasi');
            $table->date('tanggal_autorisasi');
            $table->longText('deskripsi')->nullable();
            $table->longText('lampiran')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_autorisasis');
    }
};
