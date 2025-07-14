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
            $table->decimal('sisa_bahan', 8, 2)->change();
            $table->string('unit', 20)->nullable()->after('sisa_bahan');
        });
    }
    
    public function down(): void
    {
        Schema::table('bahan_padats', function (Blueprint $table) {
            $table->string('sisa_bahan')->change();
            $table->dropColumn('unit');
        });
    }
};
