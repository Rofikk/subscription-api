<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

// Tambahkan ini:
use App\Console\Commands\SendPostEmails;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\SendPostEmails::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // 
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        
        require base_path('routes/console.php');
    }

}