<?php

namespace App\Console;

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
        Commands\clearContactForm::class,
        Commands\CrmContactForm::class,
        Commands\CrmUser::class,
        Commands\CrmSubscription::class,
        Commands\CrmCatalogues::class,
        Commands\FixDetailBugs::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('crm:clear-contact-form')->everyMinute();
        $schedule->command('crm:contact-form')->everyMinute();
        $schedule->command('crm:user')->everyMinute();
        $schedule->command('crm:subscription')->everyMinute();
        $schedule->command('crm:catalogue')->everyMinute();
        $schedule->command('fix:extras')->hourly();
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
