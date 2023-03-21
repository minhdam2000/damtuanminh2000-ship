<?php

namespace App\Console\Commands;

use App\Common\Constants;
use App\Jobs\SendMail;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Mail;


class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check trade balance have alert';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cur = DB::table("files")->orderBy("id","desc")->first();
        $files = DB::table("files")->where("created_at",">",Carbon::today())->orderBy("id","desc")->get();
                $data = ["email"=>"ttdung997@gmail.com","files"=>$files];
                 Mail::send('filemail', $data, function($message) use ($data)  {
                     $message->to($data['email'], 'Thông báo hệ thống')->subject
                        ('Thông báo hệ thống ');
                     $message->from('automail.lopital@gmail.com','Lopital');
        });
    }   

}
