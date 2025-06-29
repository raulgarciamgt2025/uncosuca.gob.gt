<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:generate-payments')->monthly();
        $schedule->command('app:expiration-notify')->weekly()->at('10:00');

        // BACKUP
        $schedule->command('backup:run --only-to-disk=s3')->daily()->at('00:00');
        $schedule->command('backup:clean')->daily()->at('01:00');

        //Borrar archivos temporales
        $schedule->command('app:clean-temporary-files')->daily()->at('00:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
