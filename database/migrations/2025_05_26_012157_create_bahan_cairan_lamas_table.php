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
        Schema::create('bahan_cairan_lamas', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('rumus_kimia', 50);
            $table->string('sisa_bahan',);
            $table->string('nomor_cas', 20)->nullable();
            $table->string('letak', 50)->nullable();
            $table->string('pemilik', 50)->nullable();
            $table->string('tahun_pengadaan', 50)->nullable();
            $table->string('expired', 50)->nullable();
            $table->string('merek', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahan_cairan_lamas');
    }
};
