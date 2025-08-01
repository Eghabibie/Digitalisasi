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
    Schema::create('peminjamans', function (Blueprint $table) {
        $table->id();
        $table->string('nama_peminjam');
        $table->string('nim_peminjam');
        $table->morphs('peminjamable');
        $table->integer('jumlah')->default(1);
        $table->date('tanggal_pinjam')->nullable();
        $table->date('tanggal_kembali')->nullable();
        $table->enum('status', [
            'Menunggu Persetujuan',
            'Disetujui',
            'Ditolak',
            'Dikembalikan'
        ])->default('Menunggu Persetujuan');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
