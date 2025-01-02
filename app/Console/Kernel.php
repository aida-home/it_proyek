<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Menambahkan penjadwalan untuk menjalankan command cek:stok setiap menit
        $schedule->command('cek:stok')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        // Memuat semua command yang ada di folder Commands
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

