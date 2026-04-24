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
        Schema::table('tbl_bidang', function (Blueprint $table) {
            $table->string('icon')->default('bi-folder')->after('kuota');
            $table->string('warna')->default('secondary')->after('icon');
        });
    }

    public function down(): void
    {
        Schema::table('tbl_bidang', function (Blueprint $table) {
            $table->dropColumn(['icon', 'warna']);
        });
    }
};
