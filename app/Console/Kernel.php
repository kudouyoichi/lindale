<?php

namespace App\Console;

use App;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [

        Commands\Lindale\LindaleUpdate::class,
        Commands\Notification\NoticeSend::class,

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('backup:clean')->daily()->at('01:00');

        $schedule->command('backup:run --only-files')->daily()->at('00:00')->when(function () {
            return App::environment('production');
        });

        $schedule->command('backup:run')->daily()->at('00:00')->when(function () {
            return App::environment('staging');
        });

        $schedule->command('notice:send')->daily()->at('10:00');
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
