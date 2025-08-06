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
            // Hapus kolom 'jumlah' kalau masih ada, karena yang dipakai adalah 'sisa_bahan'
            if (Schema::hasColumn('bahan_padats', 'jumlah')) {
                $table->dropColumn('jumlah');
            }

            // Pastikan 'sisa_bahan' ada dan posisinya setelah rumus_kimia
            if (Schema::hasColumn('bahan_padats', 'sisa_bahan')) {
                // ubah typenya kalau perlu dan pindahkan posisinya
                $table->decimal('sisa_bahan', 8, 2)->nullable()->after('rumus_kimia')->change();
            } else {
                $table->decimal('sisa_bahan', 8, 2)->nullable()->after('rumus_kimia');
            }

            // Pastikan 'unit' ada dan berada setelah 'sisa_bahan'
            if (Schema::hasColumn('bahan_padats', 'unit')) {
                $table->string('unit', 20)->nullable()->after('sisa_bahan')->change();
            } else {
                $table->string('unit', 20)->nullable()->after('sisa_bahan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bahan_padats', function (Blueprint $table) {
            // Kembalikan kolom 'jumlah' seperti semula, setelah updated_at
            if (!Schema::hasColumn('bahan_padats', 'jumlah')) {
                $table->decimal('jumlah', 8, 2)->after('updated_at');
            } else {
                $table->decimal('jumlah', 8, 2)->after('updated_at')->change();
            }

            // Pastikan 'unit' ada dan berada setelah 'jumlah'
            if (Schema::hasColumn('bahan_padats', 'unit')) {
                $table->string('unit', 20)->nullable()->after('jumlah')->change();
            } else {
                $table->string('unit', 20)->nullable()->after('jumlah');
            }

            // Hapus 'sisa_bahan' karena di down() ingin kembali ke keadaan sebelumnya
            if (Schema::hasColumn('bahan_padats', 'sisa_bahan')) {
                $table->dropColumn('sisa_bahan');
            }
        });
    }
};
