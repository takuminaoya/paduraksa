<?php

use App\Models\LaporanMasyarakat;
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
        Schema::create('whatsapp_laporans', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(LaporanMasyarakat::class)->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('whatsapp_id');
            $table->string('receipent');
            $table->longText('isi_pesan');
            $table->datetime('dikirim_pada');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_laporans');
    }
};
