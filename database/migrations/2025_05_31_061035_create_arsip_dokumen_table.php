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
        Schema::create('arsip_dokumen', function (Blueprint $table) {
            $table->id();
            $table->string('kode_dokumen');
            $table->text('keterangan')->nullable();
            $table->enum('kategori', ['Surat Masuk', 'Surat Keluar', 'Lainnya']);
            $table->string('perihal');
            $table->string('nama_dokumen');
            $table->date('tanggal_upload');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_dokumen');
    }
};
