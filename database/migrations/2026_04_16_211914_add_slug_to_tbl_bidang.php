<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tbl_bidang', function (Blueprint $table) {
            $table->string('slug')->unique()->after('nama_bidang');
        });
    }

    public function down(): void
    {
        Schema::table('tbl_bidang', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
