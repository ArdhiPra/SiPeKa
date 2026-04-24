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
        Schema::create('tbl_pengajuan_magang', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')->constrained('tbl_user')->cascadeOnDelete();
    $table->foreignId('bidang_id')->constrained('tbl_bidang')->cascadeOnDelete();

    // AUTO FILL dari profil
    $table->string('nama');
    $table->string('nomor_induk')->nullable();
    $table->enum('tingkat', ['SMA/K','D3','D4','S1','S2'])->nullable();
    $table->string('program_studi');

    // file pdf
    $table->string('file_pengajuan');

    // tanggal
    $table->date('tanggal_mulai');
    $table->date('tanggal_selesai');

    // status
    $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');

    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pengajuan_magang');
    }
};
