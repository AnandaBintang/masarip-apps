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
        Schema::table('arsip_dokumen', function (Blueprint $table) {
            $table->integer('downloaded')->default(0)->comment('Jumlah unduhan dokumen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('arsip_dokumen', function (Blueprint $table) {
            $table->dropColumn('downloaded');
        });
    }
};
