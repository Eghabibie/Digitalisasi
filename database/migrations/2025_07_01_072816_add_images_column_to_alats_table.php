<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('alats', function (Blueprint $table) {
             $table->string('images', 255)->nullable()->after('nama');
        });
    }

    public function down(): void
    {
        Schema::table('alats', function (Blueprint $table) {
            if (Schema::hasColumn('alats', 'images')) {
                $table->dropColumn('images');
            }
        });
    }
};
