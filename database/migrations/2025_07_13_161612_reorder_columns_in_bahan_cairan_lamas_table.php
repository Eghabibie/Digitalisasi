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
            if (Schema::hasColumn('bahan_cairan_lamas', 'sisa_bahan')) {
                $table->dropColumn('sisa_bahan');
            }
            $table->decimal('jumlah', 8, 2)->after('rumus_kimia')->change();
            $table->string('unit', 20)->nullable()->after('jumlah')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bahan_cairan_lamas', function (Blueprint $table) {
            $table->decimal('sisa_bahan', 8, 2)->nullable();
            $table->decimal('jumlah', 8, 2)->after('updated_at')->change();
            $table->string('unit', 20)->nullable()->after('jumlah')->change();
        });
    }
};
