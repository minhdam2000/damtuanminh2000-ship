<?php

namespace App\Console\Commands;

use App\Common\Constants;
use App\Jobs\SendMail;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use FuzzyWuzzy\Fuzz;
use FuzzyWuzzy\Process;
use FuzzyWuzzy\Collection;

use Mail;


class CalendernotiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calendernoti:check';

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

        $this->calender_noti();
        
        // $this->eventNoti();
        // $this->JobNoti();
    }

    private function calender_noti(){
        $today = Carbon::now();

        // $uids = DB::table("calender_noti")->where("seen",0)->select("calendar_id")->distinct()->pluck('calendar_id')->toArray();
        $filesday1 = DB::table("calendar_event")
        ->whereDate("created_at", $today)
        ->orderBy("id","desc")->get();
        $filesday = DB::table("calendar_event")
        ->whereDate("created_at",">=",$today)
        ->whereDate("created_at","<=",$today->addMonth())
        ->orderBy("id","desc")->get();
        dd($filesday);
      //        foreach($uids as $uid){
      //           try{
      //           $user =  DB::table("users")->where("id",$uid)->first();
      //             if($user->status == 0){
      //               continue;
      //           }
        dd($filesday);
      //           $data = ["email"=>$user->email,"files"=>$files];
      //            Mail::send('calendaremail', $data, function($message) use ($data)  {
      //                $message->to($data['email'], 'Thông báo hệ thống')->subject
      //                   ('Thông báo hệ thống ');
      //                $message->from('automail.damtuanminh2000@gmail.com','Lopital');
      // });


    }
}