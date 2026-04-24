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
        Schema::create('tbl_profil', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('tbl_user')->cascadeOnDelete();

            $table->string('nama_lengkap');
            $table->string('nomor_induk')->unique();
            $table->string('asal_instansi')->nullable();
            $table->string('program_studi')->nullable();
            $table->enum('tingkat', ['SMA/K','D3','D4','S1','S2'])->nullable();
            $table->string('telepon');
            $table->enum('jenis_kelamin', ['Laki-laki','Perempuan'])->nullable();
            $table->text('alamat_domisili');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_profil');
    }
};
