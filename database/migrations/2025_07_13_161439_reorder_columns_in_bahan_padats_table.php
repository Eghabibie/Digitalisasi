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
        Schema::table('bahan_padats', function (Blueprint $table) {
            // Langkah 1: Hapus kolom sisa_bahan jika ada
            if (Schema::hasColumn('bahan_padats', 'sisa_bahan')) {
                $table->dropColumn('sisa_bahan');
            }

            // Langkah 2: Ubah posisi kolom 'jumlah' dan 'unit'
            // Pastikan tipe datanya sudah benar (decimal untuk jumlah)
            $table->decimal('jumlah', 8, 2)->after('rumus_kimia')->change();
            $table->string('unit', 20)->nullable()->after('jumlah')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bahan_padats', function (Blueprint $table) {
            // Logika untuk mengembalikan jika migrasi di-rollback (opsional tapi baik)
            $table->decimal('sisa_bahan', 8, 2)->nullable();
            $table->decimal('jumlah', 8, 2)->after('updated_at')->change();
            $table->string('unit', 20)->nullable()->after('jumlah')->change();
        });
    }
};
