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
    Schema::table('tbl_pengajuan_magang', function (Blueprint $table) {
        $table->boolean('is_read')->default(false)->after('alasan_tolak');
    });
}

public function down(): void
{
    Schema::table('tbl_pengajuan_magang', function (Blueprint $table) {
        $table->dropColumn('is_read');
    });
}
};
