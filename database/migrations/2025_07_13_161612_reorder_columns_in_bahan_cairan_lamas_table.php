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
        Schema::table('bahan_cairan_lamas', function (Blueprint $table) {
            // Hapus kolom 'jumlah' kalau ada, karena now menggunakan 'sisa_bahan'
            if (Schema::hasColumn('bahan_cairan_lamas', 'jumlah')) {
                $table->dropColumn('jumlah');
            }

            // Pastikan 'sisa_bahan' ada dan berada setelah 'rumus_kimia'
            if (Schema::hasColumn('bahan_cairan_lamas', 'sisa_bahan')) {
                $table->decimal('sisa_bahan', 8, 2)->nullable()->after('rumus_kimia')->change();
            } else {
                $table->decimal('sisa_bahan', 8, 2)->nullable()->after('rumus_kimia');
            }

            // Pastikan 'unit' ada dan berada setelah 'sisa_bahan'
            if (Schema::hasColumn('bahan_cairan_lamas', 'unit')) {
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
        Schema::table('bahan_cairan_lamas', function (Blueprint $table) {
            // Kembalikan kolom 'jumlah' seperti semula setelah updated_at
            if (!Schema::hasColumn('bahan_cairan_lamas', 'jumlah')) {
                $table->decimal('jumlah', 8, 2)->after('updated_at');
            } else {
                $table->decimal('jumlah', 8, 2)->after('updated_at')->change();
            }

            // Pastikan 'unit' ada setelah 'jumlah'
            if (Schema::hasColumn('bahan_cairan_lamas', 'unit')) {
                $table->string('unit', 20)->nullable()->after('jumlah')->change();
            } else {
                $table->string('unit', 20)->nullable()->after('jumlah');
            }

            // Hapus 'sisa_bahan'
            if (Schema::hasColumn('bahan_cairan_lamas', 'sisa_bahan')) {
                $table->dropColumn('sisa_bahan');
            }
        });
    }
};
