<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\FuzzyCommand;
use App\Console\Commands\BuildingCommand;
use App\Console\Commands\TestCommand;
use App\Console\Commands\CleanFileCommand;
use App\Console\Commands\WeatherCommand;
use App\Console\Commands\StuffCommand;
use App\Console\Commands\PaymentCommand;
use App\Console\Commands\NotiCommand;
use Carbon\Carbon;

use DB;
use App\Project;

use Mail;

use App\Http\Requests;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        FuzzyCommand::class,
        BuildingCommand::class,
        TestCommand::class,
        CleanFileCommand::class,
        WeatherCommand::class,
        StuffCommand::class,
        PaymentCommand::class,
        NotiCommand::class,
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        // dd(Carbon::now()->subMinutes(1)->toDateTimeString());

        $schedule->command(WeatherCommand::class)->hourly();
        $schedule->command(BuildingCommand::class)->hourly();
        $schedule->command(StuffCommand::class)->hourly();

        $schedule->command(PaymentCommand::class)->dailyAt('08:05');

         $schedule->command(NotiCommand::class)->everyFiveMinutes();

 
 // $schedule->call(function () {)->daily();      




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
