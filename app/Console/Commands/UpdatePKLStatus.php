<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AnakPkl;

class UpdatePklStatus extends Command
{
    /**
     * Nama command yang dipanggil di terminal / scheduler.
     */
    protected $signature = 'update-status';

    /**
     * Deskripsi command.
     */
    protected $description = 'Update status anak PKL dari Aktif menjadi Selesai berdasarkan tanggal selesai';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \Log::info("Scheduler jalan pada: " . now());

    $today = now()->toDateString();

    $count = AnakPkl::where('status', 'Aktif')
        ->whereDate('tanggal_selesai', '<=', $today)
        ->update(['status' => 'Selesai']);

        \Log::info("Jumlah update: $count");

    return self::SUCCESS;
}

}
