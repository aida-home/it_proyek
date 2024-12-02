<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;


class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // Pastikan command stok:cek terdaftar
        $schedule->command('stok:cek')->everyMinute();
        Log::info('Scheduler dijalankan pada ' . now());
    }
    
    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
