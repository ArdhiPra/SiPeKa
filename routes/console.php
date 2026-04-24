<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
// ---------------------------------------------------------
// Scheduler: Update Status Anak PKL
// Akan mengeksekusi command update-status setiap jam 18:00
// ---------------------------------------------------------
Schedule::command('update-status')->dailyAt('09:40');