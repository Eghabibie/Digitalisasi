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
            // Ubah kolom sisa_bahan menjadi tipe desimal
            $table->decimal('sisa_bahan', 8, 2)->change();
        
            // Tambahkan kolom unit setelah kolom sisa_bahan
            $table->string('unit', 20)->nullable()->after('sisa_bahan');
        });
    }
    
    public function down(): void
    {
        Schema::table('bahan_padats', function (Blueprint $table) {
            // Kembalikan tipe data sisa_bahan jika migrasi di-rollback
            $table->string('sisa_bahan')->change();
            // Hapus kolom unit
            $table->dropColumn('unit');
        });
    }
};
