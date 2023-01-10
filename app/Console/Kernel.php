<?php

namespace App\Console;

use App\Console\Commands\BackupDatabaseCommand;
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

    protected $commands= [
        BackupDatabaseCommand::class,
    ];
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('backup:database')
            ->everyMinute()
            ->runInBackground()
            ->onSuccess(function (Stringable $output) {
                $schedule->info("processs done");
        })
        ->onFailure(function (Stringable $output) {
            $schedule->info("processs fail");
        });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
