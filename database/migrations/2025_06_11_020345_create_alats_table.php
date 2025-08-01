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
        Schema::create('alats', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('volume', 50)->nullable();
            $table->string('kondisi', 100)->nullable();
            $table->string('jumlah', 100)->nullable();
            $table->string('merek', 100)->nullable();
            $table->string('tahun_pengadaan', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alats');
    }
};
